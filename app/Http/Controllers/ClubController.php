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
    // return view('club.noticia', compact('noticia')); de momento la vista es noticiaPlantilla
    return view('club.noticiaPlantilla', compact('noticia'));

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
    return view('club.events.events', compact('events'));
}
// un event
public function showEvent($id)
{
    $event = Event::findOrFail($id); // busca por ID
    \Carbon\Carbon::setLocale('ca');
    return view('club.events.esdevenimentPlantilla', compact('event'));
}



    public function soci() { return view('club.soci'); }
    public function accesSoci() { return view('club.accesSoci'); }


// Eventos boton action
public function eventAction(Event $event)
{
    return view('club.events.action', compact('event'));
}


public function eventActionSubmit(Request $request, Event $event)
{
    switch ($event->action_type) {
        case 'inscripcio_campus':
            $data = $request->validate([
                'nom' => 'required|string|max:120',
                'data_naixement' => 'required|date',
                'tutor' => 'required|string|max:120',
                'telefon' => 'required|string|max:30',
                'email' => 'required|email',
                'intolerancies' => 'nullable|string|max:255',
                'accepto' => 'accepted',
            ]);
            // TODO: guardar en BD, enviar correu, etc.
            return back()->with('status', 'Inscripció enviada correctament!');

        case 'inscripcio_tecnificacio':
            $data = $request->validate([
                'nom' => 'required|string|max:120',
                'data_naixement' => 'required|date',
                'posicio' => 'nullable|string|max:40',
                'nivell' => 'nullable|string|max:40',
                'telefon' => 'required|string|max:30',
                'email' => 'required|email',
                'accepto' => 'accepted',
            ]);
            // TODO: guarda/envia
            return back()->with('status', 'Inscripció rebuda!');

        case 'ticket_menjar_presentacio':
        case 'ticket_menjar_soci':
            $data = $request->validate([
                'nom' => 'required|string|max:120',
                'email' => 'required|email',
                'quantitat' => 'required|integer|min:1|max:10',
            ]);

            // Calcula import (si el event té preu)
            $preu = $event->preu ?? 0;
            $total = $preu * $data['quantitat'];

            // 👉 Aquí montas la redirección a tu pasarela (ejemplo: PayPal/Stripe):
            // return redirect()->away($paypalCheckoutUrl);
            // De momento, confirmamos:
            return back()->with('status', 'Tiquets reservats. Procedirem al pagament.');

        case 'documentacio':
            $data = $request->validate([
                'fitxer' => 'required|file|max:5120', // 5MB
            ]);
            $path = $request->file('fitxer')->store('documentacio', 'public');
            // TODO: guarda referencia del fichero
            return back()->with('status', 'Document pujat correctament!');

        case 'entrades_gratuites':
            $data = $request->validate([
                'nom' => 'required|string|max:120',
                'email' => 'required|email',
                'quantitat' => 'required|integer|min:1|max:10',
            ]);
            // TODO: guardar reserva
            return back()->with('status', 'Entrada reservada! Rebràs un correu de confirmació.');

        default:
            return back()->with('status', 'Acció no disponible.');
    }
}
}
