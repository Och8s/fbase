@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tutors/jugador.css') }}?v=1.0">
@endsection

@section('content')
<div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="mb-0 gradient-text">Resum d'estadístiques del teu fill/a</h2>


    <div id="info-jugador" class="p-3 mb-4 border rounded bg-light d-flex justify-content-between align-items-center">
        <div id="dades-personals">
            Carregant dades del jugador...
        </div>
        <div id="foto-jugador">
            <img src="/images/jugadors/{{ $jugadorId }}.jpg"
                 alt="Foto jugador"
                 class="foto-jugador"
                 onerror="this.onerror=null;this.src='/images/jugadors/default.jpg';">
        </div>
    </div>

    <div id="resum">
        <!-- PARTICIPACIÓ -->
        <div class="card-body">
            <div class="estat-container">
                <div class="estat-box">
                    <p class="mb-1">Partits jugats</p>
                    <div id="j-presencia">-</div>
                </div>
                <div class="estat-box">
                    <p class="mb-1">Partits de titular</p>
                    <div id="j-titular">-</div>
                </div>
                <div class="estat-box">
                    <p class="mb-1">Minuts Totals</p>
                    <div id="minuts-total">-</div>
                </div>
                <div class="estat-box">
                    <p class="mb-1">Minuts / Partit</p>
                    <div id="minuts-x-partit">-</div>
                </div>
                <div class="estat-box">
                    <p class="mb-1">% Minuts disputats</p>
                    <div id="percentatge-minuts">-</div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-info text-white"> Punts</div>

            <div class="mitjana-punts-wrapper d-flex flex-wrap">
                <!-- Explicació -->
                <div class="triangle-explain flex-item-explicacio">
                    <h5 class="mt-3 mb-2 text-primary fw-bold">Visió de punts de l’equip en funció de la participació del jugador</h5>
                    <p>Mitjana de l'equip<strong> quan juga: <span id="punts-presencia">-</span></strong> punts per partit</p>
                    <p>Mitjana de l'equip<strong> quan és titular: <span id="punts-titular">-</span></strong> punts per partit</p>
                    <p>Mitjana de l'equip<strong> quan és al camp: <span id="punts-camp">-</span></strong> punts per partit</p>
                    <p>Mitjana global de l’<strong>equip: <span id="punts-equip">-</span></strong> punts per partit</p>
                    <h5 class="mt-3 mb-2 text-primary fw-bold">Comparació del % dels punts</h5>
                    <p><strong>Quan juga l'equip guanya el </strong><span id="percentatge-presencia">-</span> dels punts</p>
                    <p><strong>Quan és titular l'equip guanya el </strong> <span id="percentatge-titular">-</span> dels punts</p>
                    <p><strong>Quan és al camp l'equip guanya el </strong> <span id="percentatge-camp">-</span> dels punts</p>
                    <p><strong>Globalment l'equip guanya el  <span id="percentatge-equip">-</span></strong> dels punts</p>
                </div>

                <!-- Diagrama -->
                <div class="smartart-diagram flex-item-diagrama">
                    <div class="circle center">
                        L'Equip<br><span id="punts-equip-valor">-</span>
                    </div>
                    <div class="circle top">
                        Quan juga<br><span id="punts-presencia-valor">-</span>
                    </div>
                    <div class="circle left">
                        Titular<br><span id="punts-titular-valor">-</span>
                    </div>
                    <div class="circle right">
                        Al camp<br><span id="punts-camp-valor">-</span>
                    </div>
                </div>
            </div>
        </div>




        <!-- GOLS -->
<div class="card mb-3">
    <div class="card-header bg-info text-white">Gols</div>
    <div class="card-body">
        <div class="estat-container">
            <div class="estat-box box-gol">
                <p>Ha fet</p>
                <div id="gols-jugador">-</div>
                <p>gols ⚽</p>
            </div>
            <div class="estat-box box-gol">
                <p>Fa un gol cada</p>
                <div id="minuts-x-gol">-</div>
                <p>minuts ⏱️</p>
            </div>
            <div class="estat-box box-gol">
                <p>L'equip ha fet</p>
                <div id="gols-favor">-</div>
                <p>gols amb ell/a al camp</p>
            </div>
            <div class="estat-box box-gol">
                <p>L'equip ha rebut</p>
                <div id="gols-contra">-</div>
                <p>gols amb ell/a al camp</p>
            </div>
            <div class="estat-box box-gol">
                <p>Diferència de gols</p>
                <p>amb ell/a al camp</p>
                <div id="dif-gols">-</div>
            </div>
        </div>
    </div>
</div>



        <!-- COMPARATIVA -->
<div class="card mb-3 bg-comparativa">
            <h6 class="titol-comparativa text-center mb-4">
                Gols equip VS Gols amb el jugador/a al camp
            </h6>
            <div class="card-body comparativa-gols">
                <div class="columna-gols columna-esquerra">
                    <p>Mitjana de gols marcats per l’<strong>equip</strong>: <strong id="mitja-gols-favor-equip"></strong> gols/partit</p>
                    <p>Amb el <strong>jugador</strong> al camp, l’equip marca: <strong id="mitja-gols-amb-jugador"></strong> gols/partit</p>
                </div>
                <div class="columna-gols columna-dreta">
                    <p>Mitjana de gols rebuts per l’<strong>equip</strong>: <strong id="mitja-gols-contra-equip"></strong> gols/partit</p>
                    <p>Amb el <strong>jugador</strong> al camp, l’equip rep: <strong id="mitja-rebuts-amb-jugador"></strong> gols/partit</p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column align-items-center mt-5 text-center">
        <p class="text-ocre-gran fw-semibold mb-3">
            Vols rebre aquet informe al teu email ?
        </p>
        {{-- es pot fer amb AJAX en lloc de formulari--}}
        <form method="POST" action="{{ route('enviar.informe', $jugadorId) }}">
            @csrf
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button class="btn btn-gris-suau">Rebre informe</button>
            </div>
        </form>

        @if ($jugadorsCount > 1)
    <p class="text-ocre-gran fw-semibold mb-3">
        Si vols veure les estadístiques de altres jugadors al teu càrrec:
    </p>
    <div class="mt-4">
        <a href="{{ route('tutor.inici', ['from' => 'jugador']) }}" class="btn btn-gris-suau2">Torna a l'índex de jugadors</a>
    </div>
@endif


    </div>



</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const jugadorId = {{ $jugadorId }};
    function pintarComparatAmbEquip(idComparat, valorComparat, valorEquip) {
    const span = document.getElementById(idComparat);
    const vComparat = parseFloat(valorComparat);
    const vEquip = parseFloat(valorEquip);

    if (!isNaN(vComparat) && !isNaN(vEquip)) {
        if (vComparat >= vEquip) {
            span.style.color = 'green';
        } else {
            span.style.color = 'red';
        }
    }
}


    fetch(`/api/jugador/${jugadorId}`)
        .then(res => res.json())
        .then(data => {
            const j = data.jugador;
            const r = data.resum;

            document.getElementById('dades-personals').innerHTML = `
    <strong>Nom:</strong> ${j.nom} ${j.cognoms}<br>
    <strong>Data de naixement:</strong> ${j.data_naixement}<br>
    <strong>Equip:</strong> ${j.equip?.nom ?? 'Sense equip'}<br>
    <strong>Categoria:</strong> ${j.equip?.categoria ?? 'Sense categoria'}
`;


            // PARTICIPACIÓ
            document.getElementById('j-presencia').textContent = r.partits_jugats ?? '-';
            document.getElementById('j-titular').textContent = r.partits_titular ?? '-';
            document.getElementById('minuts-total').textContent = r.minuts_totals ?? '-';
            document.getElementById('minuts-x-partit').textContent = r.minuts_per_partit ?? '-';
            document.getElementById('percentatge-minuts').textContent = r.percentatge_minuts !== null ? r.percentatge_minuts + '%' : '-';

            // MITJANA DE PUNTS
            document.getElementById('punts-presencia').textContent = r.mitjana_punts_presencia ?? '-';
            document.getElementById('punts-titular').textContent = r.mitjana_punts_titular ?? '-';
            document.getElementById('punts-camp').textContent = r.mitjana_punts_camp ?? '-';
            document.getElementById('punts-equip').textContent = r.mitjana_punts_equip ?? '-';

            document.getElementById('punts-presencia-valor').textContent = r.mitjana_punts_presencia ?? '-';
            document.getElementById('punts-titular-valor').textContent = r.mitjana_punts_titular ?? '-';
            document.getElementById('punts-camp-valor').textContent = r.mitjana_punts_camp ?? '-';
            document.getElementById('punts-equip-valor').textContent = r.mitjana_punts_equip ?? '-';

            const percentatgePresencia = r.mitjana_punts_presencia !== null ? ((r.mitjana_punts_presencia * 100) / 3).toFixed(1) + '%' : '-';
            const percentatgeTitular = r.mitjana_punts_titular !== null ? ((r.mitjana_punts_titular * 100) / 3).toFixed(1) + '%' : '-';
            const percentatgeCamp = r.mitjana_punts_camp !== null ? ((r.mitjana_punts_camp * 100) / 3).toFixed(1) + '%' : '-';
            const percentatgeEquip = r.mitjana_punts_equip !== null ? ((r.mitjana_punts_equip * 100) / 3).toFixed(1) + '%' : '-';

            document.getElementById('percentatge-presencia').textContent = percentatgePresencia;
            document.getElementById('percentatge-titular').textContent = percentatgeTitular;
            document.getElementById('percentatge-camp').textContent = percentatgeCamp;
            document.getElementById('percentatge-equip').textContent = percentatgeEquip;

            // Pintar els percentatges en verd o vermell segons la mitjana global
            pintarComparatAmbEquip('percentatge-presencia', percentatgePresencia.replace('%', ''), percentatgeEquip.replace('%', ''));
            pintarComparatAmbEquip('percentatge-titular', percentatgeTitular.replace('%', ''), percentatgeEquip.replace('%', ''));
            pintarComparatAmbEquip('percentatge-camp', percentatgeCamp.replace('%', ''), percentatgeEquip.replace('%', ''));

            // GOLS
            document.getElementById('gols-jugador').textContent = r.gols_jugador ?? '-';
            document.getElementById('minuts-x-gol').textContent = r.minuts_per_gol ?? '-';
            document.getElementById('gols-favor').textContent = r.gols_favor_jec ?? '-';
            document.getElementById('gols-contra').textContent = r.gols_contra_jec ?? '-';
            document.getElementById('dif-gols').textContent = r.dif_gols_jec ?? '-';


            // COMPARATIVA
            document.getElementById('mitja-gols-amb-jugador').textContent = r.mitjana_gols_partit_amb ?? '-';
            document.getElementById('mitja-rebuts-amb-jugador').textContent = r.mitjana_gols_rebuts_amb ?? '-';
            document.getElementById('mitja-gols-favor-equip').textContent = r.mitjana_gols_favor_equip ?? '-';
            document.getElementById('mitja-gols-contra-equip').textContent = r.mitjana_gols_contra_equip ?? '-';
            // Comparació gols marcats
const golsFavorEquip = parseFloat(r.mitjana_gols_favor_equip);
const golsFavorAmb = parseFloat(r.mitjana_gols_partit_amb);
const spanFavor = document.getElementById('mitja-gols-amb-jugador');

if (!isNaN(golsFavorEquip) && !isNaN(golsFavorAmb)) {
    spanFavor.style.color = golsFavorAmb > golsFavorEquip ? 'green' : 'red';
}

// Comparació gols rebuts
const golsContraEquip = parseFloat(r.mitjana_gols_contra_equip);
const golsContraAmb = parseFloat(r.mitjana_gols_rebuts_amb);
const spanContra = document.getElementById('mitja-rebuts-amb-jugador');

if (!isNaN(golsContraEquip) && !isNaN(golsContraAmb)) {
    spanContra.style.color = golsContraAmb > golsContraEquip ? 'red' : 'green';
}


        })
        .catch(err => {
            console.error('Error carregant dades:', err);
            document.getElementById('info-jugador').innerHTML =
                `<div class="alert alert-danger">Error carregant dades del jugador.</div>`;
        });
});
</script>
<script>
    // Fer desaparèixer alertes de sessió després de 4 segons
    setTimeout(() => {
        const alertSuccess = document.querySelector('.alert-success');
        const alertError = document.querySelector('.alert-danger');

        if (alertSuccess) {
            alertSuccess.style.transition = "opacity 0.5s ease";
            alertSuccess.style.opacity = 0;
            setTimeout(() => alertSuccess.remove(), 500);
        }

        if (alertError) {
            alertError.style.transition = "opacity 0.5s ease";
            alertError.style.opacity = 0;
            setTimeout(() => alertError.remove(), 500);
        }
    }, 4000);
</script>

@endsection
