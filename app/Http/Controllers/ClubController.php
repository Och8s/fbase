<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Descripcio;
use App\Models\Event;

use Illuminate\Validation\Rule;
use App\Models\PreCampus;
use App\Models\PreTecnificacio;
use App\Models\PreSoci;




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



    public function soci()
{
    return view('club.formulariSoci'); // <- el teu fitxer
}

public function storeSoci(Request $request)
{
    $validated = $request->validate([
        'name'          => ['required','string','max:255'],
        'email'         => ['required','email','max:255','unique:socis,email'],
        'dni'           => ['required','string','max:20','unique:socis,dni'],
        'data_naix'     => ['required','date'],
        'telefon'       => ['required','string','max:30'],
        'adreca'        => ['required','string','max:255'],
        'poblacio'      => ['required','string','max:120'],
        'numero_compte' => ['required','string','max:34'], // IBAN fins a 34
        'user_id'       => ['nullable','integer','exists:users,id'],
        // 'estat' no ve del formulari: el posem nosaltres
    ]);

    $validated['estat'] = 'pendent';

    PreSoci::create($validated);

    return redirect()
        ->route('club.soci')
        ->with('status', 'Sol·licitud enviada! Et contactarem ben aviat.');
}

// Eventos boton action

    // Botón acción → muestra vista contenedora que incluye el parcial
    public function eventAction(Event $event)
    {
        // (opcional) título según action_type
        $titles = [
            'inscripcio_campus'        => 'Inscripció Campus',
            'inscripcio_tecnificacio'  => 'Inscripció Tecnificació',
            'ticket_menjar_presentacio'=> 'Compra tiquet de menjar',
            'ticket_menjar_soci'       => 'Compra tiquet soci',
            'documentacio'             => 'Enviar documentació',
            'entrades_gratuites'       => 'Reservar entrada',
        ];

        return view('club.events.action', [
            'event' => $event,
            'title' => $titles[$event->action_type] ?? 'Acció',
        ]);
    }
public function eventActionSubmit(Request $request, Event $event)
    {
        switch ($event->action_type) {

            // ======================
            // INSCRIPCIÓ CAMPUS
            // ======================
            case 'inscripcio_campus': {
                // Reglas base comunes (coinciden con tu formulario)
                $rulesBase = [
                    'es_jugador_club'     => ['required', Rule::in(['0','1'])],
                    'dni'                 => ['required','string','max:20'], // puedes afinar regex DNI/NIE
                    'telefon'             => ['nullable','string','max:50'],
                    'email'               => ['nullable','email','max:255'],
                    'usar_compte_registrat' => ['nullable', Rule::in(['0','1'])],
                    'num_compte'          => [Rule::requiredIf(fn()=> $request->input('usar_compte_registrat') === '0'),
                                              'nullable','string','max:34'],
                    'intolerancia'        => ['nullable','string','max:500'],
                    'incapacitat'         => ['nullable','string','max:500'],
                    'recollida'           => ['nullable','boolean'],
                    'observacions'        => ['nullable','string','max:2000'],
                    'consentiment_pares'  => ['accepted'],
                    'drets_imatge'        => ['nullable','boolean'],
                ];

                // Si NO és del club, pedimos los datos completos del menor
                if ($request->input('es_jugador_club') === '0') {
                    $rulesExtra = [
                        'nom'              => ['required','string','max:255'],
                        'cognoms'          => ['required','string','max:255'],
                        'data_naixement'   => ['required','date'],
                        'seg_social'       => ['nullable','string','max:50'],
                        'domicili'         => ['nullable','string','max:255'],
                        'cp'               => ['nullable','string','max:20'],
                        'nom_pares'        => ['nullable','string','max:255'],
                    ];
                } else {
                    $rulesExtra = []; // del club: no exigimos/mostramos datos personales
                }

                $data = $request->validate($rulesBase + $rulesExtra);

                // Normaliza booleanos
                $data['es_jugador_club']    = $request->input('es_jugador_club') === '1' ? 1 : 0;
                $data['consentiment_pares'] = $request->boolean('consentiment_pares');
                $data['drets_imatge']       = $request->boolean('drets_imatge');
                $data['recollida']          = $request->boolean('recollida');

                // Si NO se marcó “usar compte alternatiu”, no guardes num_compte
                if (($data['usar_compte_registrat'] ?? '1') !== '0') {
                    unset($data['num_compte']);
                }

                // Enlaza con el event
                $data['event_id'] = $event->id;

                // (Opcional) si es del club y quieres asociar jugador_id por DNI:
                // $jug = \App\Models\Jugador::where('dni',$data['dni'])->first();
                // if ($jug) $data['jugador_id'] = $jug->id;

                PreCampus::create($data);

                return back()->with('status', 'Inscripció enviada correctament!');
            }

            // ======================
            // INSCRIPCIÓ TECNIFICACIÓ
            // ======================
            case 'inscripcio_tecnificacio': {
                // Reglas base (tecnificació NO tiene “recollida” ni “intolerancia” según lo que decidiste)
                $rulesBase = [
                    'es_jugador_club'     => ['required', Rule::in(['0','1'])],
                    'dni'                 => ['required','string','max:20'],
                    'telefon'             => ['nullable','string','max:50'],
                    'email'               => ['nullable','email','max:255'],
                    'usar_compte_registrat' => ['nullable', Rule::in(['0','1'])],
                    'num_compte'          => [Rule::requiredIf(fn()=> $request->input('usar_compte_registrat') === '0'),
                                              'nullable','string','max:34'],
                    'incapacitat'         => ['nullable','string','max:500'],
                    'observacions'        => ['nullable','string','max:2000'],
                    'consentiment_pares'  => ['accepted'],
                    'drets_imatge'        => ['nullable','boolean'],
                ];

                if ($request->input('es_jugador_club') === '0') {
                    $rulesExtra = [
                        'nom'              => ['required','string','max:255'],
                        'cognoms'          => ['required','string','max:255'],
                        'data_naixement'   => ['required','date'],
                        'seg_social'       => ['nullable','string','max:50'],
                        'domicili'         => ['nullable','string','max:255'],
                        'cp'               => ['nullable','string','max:20'],
                        'nom_pares'        => ['nullable','string','max:255'],
                    ];
                } else {
                    $rulesExtra = [];
                }

                $data = $request->validate($rulesBase + $rulesExtra);

                $data['es_jugador_club']    = $request->input('es_jugador_club') === '1' ? 1 : 0;
                $data['consentiment_pares'] = $request->boolean('consentiment_pares');
                $data['drets_imatge']       = $request->boolean('drets_imatge');

                if (($data['usar_compte_registrat'] ?? '1') !== '0') {
                    unset($data['num_compte']);
                }

                $data['event_id'] = $event->id;

                // (Opcional) asociar jugador
                // $jug = \App\Models\Jugador::where('dni',$data['dni'])->first();
                // if ($jug) $data['jugador_id'] = $jug->id;

                PreTecnificacio::create($data);

                return back()->with('status', 'Inscripció rebuda!');
            }

            // ======================
            // TIQUETS / ALTRES
            // ======================
            case 'ticket_menjar_presentacio':
            case 'ticket_menjar_soci': {
                $data = $request->validate([
                    'nom'       => 'required|string|max:120',
                    'email'     => 'required|email',
                    'quantitat' => 'required|integer|min:1|max:10',
                ]);

                $preu  = $event->preu ?? 0;
                $total = $preu * $data['quantitat'];

                // TODO: redirección a pasarela de pago con $total
                return back()->with('status', 'Tiquets reservats. Procedirem al pagament.');
            }

            case 'documentacio': {
                $data = $request->validate([
                    'fitxer' => 'required|file|max:5120', // 5MB
                ]);
                $path = $request->file('fitxer')->store('documentacio', 'public');
                // TODO: guardar referencia del fichero (event_id, user/email, etc.)
                return back()->with('status', 'Document pujat correctament!');
            }

            case 'entrades_gratuites': {
                $data = $request->validate([
                    'nom'       => 'required|string|max:120',
                    'email'     => 'required|email',
                    'quantitat' => 'required|integer|min:1|max:10',
                ]);
                // TODO: guardar reserva con event_id
                return back()->with('status', 'Entrada reservada! Rebràs un correu de confirmació.');
            }

            default:
                return back()->with('status', 'Acció no disponible.');
        }
    }
// FIN EVENETOS........................................................

}
