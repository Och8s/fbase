<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Descripcio;
use App\Models\Event;




class ClubController extends Controller
{
    public function index()
    {
        return view('club.index'); // Aquesta és la vista que ja tens creada
    }

// 1 NOTICIES
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

// UTILITCEM PLANTILLA  PER A TOTS
public function mostrarQuiSom()
{
    $descripcio = Descripcio::find(1);
    return view('club.descripcioPlantilla', compact('descripcio'));
}

public function mostrarObjectius()
{
    $descripcio = Descripcio::find(2);
    return view('club.descripcioPlantilla', compact('descripcio'));
}

// 2 EVENTS

    public function events() {
$events = Event::orderBy('id', 'asc')->get();
    return view('club.events', compact('events'));
}

    public function soci() { return view('club.soci'); }
    public function accesSoci() { return view('club.accesSoci'); }
}
