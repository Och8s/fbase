<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\PrimerEquipController;
use App\Http\Controllers\SegonEquipController;
use App\Http\Controllers\PortersController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\PatrocinadorsController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/vista/general', [ClubController::class, 'index'])->name('club.index'); // ✅ AFEGIT

Route::prefix('club')->name('club.')->group(function () {
    Route::get('/noticies', [ClubController::class, 'noticies'])->name('noticies');
    Route::get('/qui-som', [ClubController::class, 'quiSom'])->name('qui');
    Route::get('/objectius', [ClubController::class, 'objectius'])->name('objectius');
    Route::get('/events', [ClubController::class, 'events'])->name('events');
    Route::get('/fes-te-soci', [ClubController::class, 'soci'])->name('soci');
    Route::get('/acces-soci', [ClubController::class, 'accesSoci'])->name('accesSoci');
});



Route::prefix('escola')->name('escola.')->group(function () {
    Route::get('/', [EscolaController::class, 'index'])->name('index');
    Route::get('/formacio', [EscolaController::class, 'formacio'])->name('formacio');
    Route::get('/equips', [EscolaController::class, 'equips'])->name('equips');
    Route::get('/estil', [EscolaController::class, 'estil'])->name('estil');
    Route::get('/metodologia', [EscolaController::class, 'metodologia'])->name('metodologia');
    Route::get('/acces-entrenador', [EscolaController::class, 'accesEntrenador'])->name('accesEntrenador');
    Route::get('/acces-coordinador', [EscolaController::class, 'accesCoordinador'])->name('accesCoordinador');
});

Route::prefix('primer-equip')->name('primer.')->group(function () {
    Route::get('/', [PrimerEquipController::class, 'index'])->name('index');
    Route::get('/plantilla', [PrimerEquipController::class, 'plantilla'])->name('plantilla');
    Route::get('/calendari', [PrimerEquipController::class, 'calendari'])->name('calendari');
    Route::get('/jornada', [PrimerEquipController::class, 'jornada'])->name('jornada');
    Route::get('/resultats', [PrimerEquipController::class, 'resultats'])->name('resultats');
    Route::get('/classificacio', [PrimerEquipController::class, 'classificacio'])->name('classificacio');
});


Route::prefix('segon-equip')->name('segon.')->group(function () {
    Route::get('/', [SegonEquipController::class, 'index'])->name('index');
    Route::get('/plantilla', [SegonEquipController::class, 'plantilla'])->name('plantilla');
    Route::get('/calendari', [SegonEquipController::class, 'calendari'])->name('calendari');
    Route::get('/jornada', [SegonEquipController::class, 'jornada'])->name('jornada');
    Route::get('/resultats', [SegonEquipController::class, 'resultat'])->name('resultat');
    Route::get('/classificacio', [SegonEquipController::class, 'classificacio'])->name('classificacio');
});


// Escola de Porters
Route::prefix('porters')->name('porters.')->group(function () {
    Route::get('/', [PortersController::class, 'index'])->name('index');
    Route::get('/formacio', [PortersController::class, 'formacio'])->name('formacio');
    Route::get('/horari', [PortersController::class, 'horari'])->name('horari');
    Route::get('/entrenadors', [PortersController::class, 'entrenadors'])->name('entrenadors');
    Route::get('/plans', [PortersController::class, 'plans'])->name('plans');
    Route::get('/contacte', [PortersController::class, 'contacte'])->name('contacte');
});

Route::prefix('secretaria')->name('secretaria.')->group(function () {
    Route::get('/', [SecretariaController::class, 'index'])->name('index');
    Route::get('/oficina', [SecretariaController::class, 'oficina'])->name('oficina');
    Route::get('/inscripcions', [SecretariaController::class, 'inscripcions'])->name('inscripcions');
    Route::get('/merchandasing', [SecretariaController::class, 'merchandasing'])->name('merchandasing');
    Route::get('/normativa', [SecretariaController::class, 'normativa'])->name('normativa');
    Route::get('/contacte', [SecretariaController::class, 'contacte'])->name('contacte');
    Route::get('/acces', [SecretariaController::class, 'acces'])->name('acces');
});

Route::prefix('historia')->name('historia.')->group(function () {
    Route::get('/', [HistoriaController::class, 'index'])->name('index');
    Route::get('/ressenya', [HistoriaController::class, 'ressenya'])->name('ressenya');
    Route::get('/cronologia', [HistoriaController::class, 'cronologia'])->name('cronologia');
    Route::get('/fotografies', [HistoriaController::class, 'fotografies'])->name('fotografies');
    Route::get('/envians', [HistoriaController::class, 'envians'])->name('envians');
});

Route::get('/patrocinadors', [PatrocinadorsController::class, 'index'])->name('patrocinadors.index');


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
