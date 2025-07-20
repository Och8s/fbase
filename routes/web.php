<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\EmailController;

Route::post('/jugadors/{id}/enviar-informe', [EmailController::class, 'enviarInformeJugador'])->name('enviar.informe');
Route::post('/enviar-informes/equip/{equipId}', [EmailController::class, 'enviarInformesEquip'])->name('enviar.informes.equip');

// Rutes protegides (usuari autenticat amb Laravel Jetstream)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard predeterminat
    Route::get('/dashboard', function () {
        $user = request()->user();

        if ($user->rol === 'entrenador') {
            return redirect('/vista/entrenador');
        }

        if ($user->rol === 'tutor') {
            return redirect('/vista/tutor');
        }

        return view('dashboard'); // per altres rols o si cal
    })->name('dashboard');


    // ✅ NOVA RUTA per a la vista principal de l'entrenador
    Route::get('/vista/entrenador', function () {
    return view('entrenadors.vista');
})->middleware('isEntrenador')->name('vista');



    // Ryuta per anar a un partit concretcomo entrenador
    Route::middleware('isEntrenador')->get('/vista/partit/{id}', function ($id) {
        return view('entrenadors.partit', ['partitId' => $id]);
    });

      // Ryuta per anar a un equip concret como entrenador
      Route::middleware('isEntrenador')->get('/vista/equip/{id}', function ($id) {
        return view('entrenadors.equip', ['partitId' => $id]);
    });

    // Vista detall d’un jugador per ENTRENADOR
    Route::middleware('isEntrenador')->get('/vista/jugadors/{id}', function ($id) {
        return view('entrenadors.jugador', ['jugadorId' => $id]);
    });

    // Vista detall d’un jugador per TUTOR
   Route::get('/vista/jugador/{id}', function ($id) {
    $user = request()->user();

    // Comprovació: aquest jugador està associat al tutor?
    $jugador = $user->jugadors()->where('jugadors.id', $id)->first();

    if (!$jugador) {
        abort(403, 'No tens accés a aquest jugador.');
    }

    $jugadorsCount = $user->jugadors()->count();

    return view('tutors.jugador', [
        'jugadorId' => $id,
        'jugadorsCount' => $jugadorsCount,
    ]);
})->middleware(['isTutor'])->name('tutors.jugador');




    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'isTutor'])->group(function () {
        Route::get('/vista/tutor', function () {
            $user = request()->user();
            $jugadors = $user->jugadors()->with('equip')->get(); // Relació definida al model User

            return view('tutors.index', compact('jugadors'));
        })->name('tutor.inici');


    });


});
