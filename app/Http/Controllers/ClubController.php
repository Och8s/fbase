<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;


class ClubController extends Controller
{
    public function index()
    {
        return view('club.index'); // Aquesta és la vista que ja tens creada
    }

    // Pots afegir més mètodes com aquests quan els necessitis:

public function noticies()
{
    $noticies = Noticia::orderBy('data', 'desc')->take(6)->get();
    return view('club.noticies', compact('noticies'));
}

public function veureNoticia($id)
{
    $noticia = Noticia::findOrFail($id);
    return view('club.noticia', compact('noticia'));
}

public function noticiesAntigues()
{
    $noticiesAntigues = Noticia::whereDate('data', '<', now()->subMonth())
        ->orderBy('data', 'desc')
        ->paginate(12);

    return view('club.noticiesAntigues', compact('noticiesAntigues'));
}


    public function quiSom() { return view('club.qui'); }
    public function objectius() { return view('club.objectius'); }
    public function events() { return view('club.events'); }
    public function soci() { return view('club.soci'); }
    public function accesSoci() { return view('club.accesSoci'); }
}
