<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutes protegides (usuari autenticat amb Laravel Jetstream)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard predeterminat
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ NOVA RUTA per a la vista principal de l'entrenador
    Route::get('/vista/entrenador', function () {
        return view('entrenadors.vista');
    })->middleware('isEntrenador');


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
    Route::middleware('isTutor')->get('/vista/jugador/{id}', function ($id) {
        return view('pares.jugador', ['jugadorId' => $id]);
    });
});
