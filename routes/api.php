<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    PartitsController,
    EstadistiquesController,
    GolsController,
    CanvisController,
    JugadorsController,
    UsuarisController,
    EquipsController,
    PreSociController
};

// RUTA DE TEST USER
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Usuari actiu (autenticat amb qualsevol rol) // dades del usuari
Route::middleware(['auth:sanctum'])->get('usuari/actiu', [UsuarisController::class, 'showAuth']);

/*
|--------------------------------------------------------------------------
| RUTES PER ENTRENADORS - poden MODIFICAR partits, gols, canvis i estadístiques
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'isEntrenador'])->group(function () {

    // PARTITS
    Route::get('partits', [PartitsController::class, 'index']);
    Route::get('partits/{id}', [PartitsController::class, 'show']);
    Route::put('partits/{id}', [PartitsController::class, 'updateEntrenador']);
    // Aquesta update inclourà modificar: gols a favor, gols en contra, resultat i estat del partit

    // GOLS
    Route::post('gols', [GolsController::class, 'store']);
    Route::put('gols/{id}', [GolsController::class, 'update']);
    Route::delete('gols/{id}', [GolsController::class, 'destroy']);

    // CANVIS
    Route::post('canvis', [CanvisController::class, 'store']);
    Route::put('canvis/{id}', [CanvisController::class, 'update']);
    Route::delete('canvis/{id}', [CanvisController::class, 'destroy']);

    // ESTADÍSTIQUES
    Route::post('estadistiques', [EstadistiquesController::class, 'store']);
    Route::put('estadistiques/{id}', [EstadistiquesController::class, 'update']);
    Route::delete('estadistiques/{id}', [EstadistiquesController::class, 'destroy']);

    // Vista jugador (com la veu l’entrenador)
    Route::get('jugadors/{id}', [JugadorsController::class, 'vistaEntrenador']);

    Route::get('/equips/{equipId}/jugadors/estadistiques', [JugadorsController::class, 'jugadorsAmbEstadistiques']);


    // EQUIPS (lectura)
    Route::get('equips', [EquipsController::class, 'index']);
    Route::get('equips/{id}', [EquipsController::class, 'show']);// dades generals d'un equip
    Route::get('equips/{id}/jugadors', [EquipsController::class, 'jugadors']); // dades generals dels jugadors d'un equip
    Route::get('equips/{id}/partits', [EquipsController::class, 'partits']); // dades generals de partit



    // USUARIS (lectura)
    Route::get('usuaris', [UsuarisController::class, 'index']);
    Route::get('usuaris/{id}', [UsuarisController::class, 'show']);

    // Retorna l'equip associat a l'entrenador autenticat
    Route::get('equip-del-meu-usuari', function () {
        $user = request()->user(); // si estàs dins d'una funció de ruta
        $equip = \App\Models\Equip::where('entrenador_id', $user->id)->first();

        if (!$equip) {
            return response()->json(['error' => 'No tens cap equip assignat'], 404);
        }

        return response()->json($equip);
    });

    // finalment no utilitzades
Route::delete('estadistiques/partit/{partitId}', [EstadistiquesController::class, 'deleteByPartit']);
Route::delete('gols/partit/{partitId}', [GolsController::class, 'deleteByPartit']);
Route::delete('canvis/partit/{partitId}', [CanvisController::class, 'deleteByPartit']);
// AQUESTA ENGLOVA LES ALTRES... ho fara al model partit tot
Route::delete('partits/{id}/netejar-dades', [PartitsController::class, 'netejarDadesAssociades']);

});

/*
|--------------------------------------------------------------------------
| RUTES PER TUTORS - només LECTURA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'isTutor'])->group(function () {

    // Vista jugador (com la veu el tutor)
    Route::get('jugador/{id}', [JugadorsController::class, 'vistaTutor']);
});


Route::middleware('auth:sanctum')->get('debug-user', function (Request $request) {
    return response()->json([
        'id' => $request->user()?->id,
        'rol' => $request->user()?->rol,
    ]);
});

Route::middleware(['auth:sanctum', 'isTutor'])->get('tutor/jugadors', function () {
    return request()->user()->jugadors; // assumeix que el model User té una relació 'jugadors()'
});
use App\Http\Controllers\Api\ProExercicisController;
use App\Http\Controllers\Api\ExercicisController;


Route::middleware(['auth:sanctum', 'isEntrenador'])->group(function () {
    // PROEXERCICIS
    Route::get('proexercicis', [ProExercicisController::class, 'index']);
    Route::post('proexercicis', [ProExercicisController::class, 'store']);
    Route::get('proexercicis/{id}', [ProExercicisController::class, 'show']);
    Route::put('proexercicis/{id}', [ProExercicisController::class, 'update']);
    Route::delete('proexercicis/{id}', [ProExercicisController::class, 'destroy']);

    // EXERCICIS
    Route::get('exercicis', [ExercicisController::class, 'index']);
    Route::post('exercicis', [ExercicisController::class, 'store']);
    Route::get('exercicis/{id}', [ExercicisController::class, 'show']);
    Route::put('exercicis/{id}', [ExercicisController::class, 'update']);
    Route::delete('exercicis/{id}', [ExercicisController::class, 'destroy']);
});

Route::put('/presocis/{id}/acceptar', [PreSociController::class, 'acceptar']);
Route::put('/presocis/{id}/rebutjar', [PreSociController::class, 'rebutjar']);

