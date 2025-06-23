@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/entrenadors/equip.css') }}?v=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

@endsection
@section('content')
<div class="container mt-4">
<div class="d-flex align-items-center gap-3 mb-4">
<h2 class="mb-0 gradient-text">Estadístiques de l'equip</h2>

</div>

       {{-- Info del equip --}}
    <div id="info-equip" class="alert alert-primary">
        Carregant dades del equip...
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <!-- Fila de grups -->
                <tr class="table-primary text-center">
                    <th rowspan="2">Jugador</th>
                    <th colspan="4">Partits</th>
                    <th colspan="1">Gols</th>
                    <th colspan="5">Punts Equip</th>
                    <th colspan="3">Gols Equip Jac</th>
                </tr>
                <!-- Fila de detalls -->
                <tr class="text-center">
                    <th>Jugats</th>
                    <th>Titular</th>
                    <th>Minuts</th>
                    <th>⏱ p.p.</th>
                    <th>⚽</th>  <!-- sota Gols -->
                    <th>Jug JP</th>
                    <th>Mitj JJP</th>
                    <th>Jug ac</th>
                    <th>Mitj Jac</th>
                    <th>Mitj Tit</th>
                    <th>favor</th>
                    <th>contra</th>
                    <th>Dif</th>
                </tr>
            </thead>
            <tbody id="taulaEstadistiques">
                <!-- Dades carregades via JS -->
            </tbody>
        </table>
    </div>
</div>
<div class="text-center mt-4">
    <a href="{{ url('/vista/entrenador') }}" class="btn btn-gris-suau2">
        🔙 Torna a la vista principal
    </a>
</div>
<h4>GRÀFIC ESTADÍSTIC</h4>
{{-- Contenidor pels gràfics --}}
<div id="grafics-dos" class="grafic-flex">
    <div class="grafic-box">
        <h4 class="text-center">Minuts jugats per jugador</h4>
        <div id="grafics-container"></div> <!-- Aquí es genera el canvas #grafMinuts -->
    </div>

</div>


@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    const equipId = window.location.pathname.split('/').pop();

    document.addEventListener("DOMContentLoaded", function () {
        fetch(`/api/equips/${equipId}/jugadors/estadistiques`)
            .then(res => res.json())
            .then(jugadors => {
                const taula = document.getElementById("taulaEstadistiques");
                taula.innerHTML = "";

                const nomsJugadorsMinuts = [];
                const minutsJugatsTot = [];
                const datasetsJJP = [];
                let maxNumJornades = 0;

                jugadors.forEach((jugador, i) => {
                    const estadistiques = jugador.estadistiques || [];

                    const partitsJugats = estadistiques.filter(e => e.partido_jugado).length;
                    const titulars = estadistiques.filter(e => e.titular).length;
                    const minuts = estadistiques.reduce((acc, e) => acc + (e.minuts_jugats || 0), 0);
                    const gols = estadistiques.reduce((acc, e) => acc + (e.gols_jugador || 0), 0);
                    const puntsJJP = estadistiques.reduce((acc, e) => acc + (e.punts_equip_jjp || 0), 0);
                    const puntsJEC = estadistiques.reduce((acc, e) => acc + (e.punts_equip_jec || 0), 0);
                    const favorJEC = estadistiques.reduce((acc, e) => acc + (e.gols_favor_jec || 0), 0);
                    const contraJEC = estadistiques.reduce((acc, e) => acc + (e.gols_contra_jec || 0), 0);
                    const dif = estadistiques.reduce((acc, e) => acc + (e.dif_gols_jec || 0), 0);

                    const mpp = partitsJugats > 0 ? Math.round(minuts / partitsJugats) : '-';
                    const meqRaw = partitsJugats > 0 ? puntsJJP / partitsJugats : null;
                    const meq = meqRaw !== null ? (Number.isInteger(meqRaw) ? meqRaw : meqRaw.toFixed(1)) : '-';
                    const mjcRaw = partitsJugats > 0 ? puntsJEC / partitsJugats : null;
                    const mjc = mjcRaw !== null ? (Number.isInteger(mjcRaw) ? mjcRaw : mjcRaw.toFixed(1)) : '-';

                    const partitsTitular = estadistiques.filter(e => e.titular);
                    const totalPuntsTitular = partitsTitular.reduce((suma, stat) => suma + (stat.punts_equip_jjp || 0), 0);
                    const medPetRaw = partitsTitular.length ? totalPuntsTitular / partitsTitular.length : '-';
                    const medPet = medPetRaw !== '-' && !Number.isInteger(medPetRaw) ? medPetRaw.toFixed(1) : medPetRaw;

                    const fila = document.createElement('tr');
                    fila.innerHTML = `
                        <td>${jugador.nom} ${jugador.cognoms}</td>
                        <td>${partitsJugats}</td>
                        <td>${titulars}</td>
                        <td>${minuts}</td>
                        <td>${mpp}</td>
                        <td>${gols}</td>
                        <td>${puntsJJP}</td>
                        <td>${meq}</td>
                        <td class="negreta">${puntsJEC}</td>
                        <td class="negreta">${mjc}</td>
                        <td class="negreta">${medPet}</td>
                        <td class="negreta">${favorJEC}</td>
                        <td class="negreta">${contraJEC}</td>
                        <td class="negreta">${dif}</td>
                    `;
                    taula.appendChild(fila);

                    nomsJugadorsMinuts.push(`${jugador.nom} ${jugador.cognoms}`);
                    minutsJugatsTot.push(minuts);

                    const ordenades = estadistiques
                        .filter(e => e.partit && e.partit.jornada !== null)
                        .sort((a, b) => a.partit.jornada - b.partit.jornada);

                    const jornadaMaximaJugador = ordenades.length > 0
                        ? Math.max(...ordenades.map(e => e.partit.jornada))
                        : 0;
                    maxNumJornades = Math.max(maxNumJornades, jornadaMaximaJugador);

                    let sumaJornada = 0;
                    const puntsJornada = [];
const tooltipData = [];

const jitter = i * 0.10;

ordenades.forEach(e => {
    const jornada = e.partit.jornada - 1;
    sumaJornada += e.punts_equip_jjp ?? 0;
    puntsJornada[jornada] = sumaJornada + jitter;
    tooltipData[jornada] = sumaJornada;
});

// Omplim buits
for (let j = 0; j < jornadaMaximaJugador; j++) {
    if (puntsJornada[j] == null) {
        puntsJornada[j] = j > 0 ? puntsJornada[j - 1] : 0;
        tooltipData[j] = j > 0 ? tooltipData[j - 1] : 0;
        puntsJornada[j] += jitter;
    }
}

// datasetsJJP.push({
//     label: `${jugador.nom} ${jugador.cognoms}`,
//     data: puntsJornada,
//     tooltipData: tooltipData, // <-- passem dades extres
//     borderColor: `hsl(${i * 30}, 70%, 50%)`,
//     borderWidth: 1,
//     fill: false,
//     tension: 0.3
// });


                });

                renderitzarGrafMinuts(nomsJugadorsMinuts, minutsJugatsTot);
                // ✅ Destrueix DataTable si ja existeix (evita errors si recarregues dades dinàmicament)
if ($.fn.DataTable.isDataTable('.table')) {
    $('.table').DataTable().destroy();
}

// ✅ Inicialitza DataTables
$('.table').DataTable({
    paging: false,      // No volem paginació
    info: false,        // Amaga el text de "X files mostrats"
    ordering: true,     // Ordenació habilitada
    language: {
        search: "Cerca:",
        zeroRecords: "No s'han trobat registres",
        emptyTable: "No hi ha dades disponibles",
        loadingRecords: "Carregant...",
        processing: "Processant...",
        paginate: {
            first: "Primer",
            last: "Últim",
            next: "Següent",
            previous: "Anterior"
        }
    }
});

            });

        fetch(`/api/equips/${equipId}`)
            .then(res => res.json())
            .then(equip => {
    document.getElementById('info-equip').innerHTML = `
    <div class="info-equip-content d-flex justify-content-between align-items-center flex-wrap">
        <div class="mb-2 mb-md-0">
            <strong>Nom equip:</strong> ${equip.nom}<br>
            <strong>Categoria:</strong> ${equip.categoria}
        </div>
        <img src="/imagesGeneral/logoEscola.png" alt="Logo Escola" class="logo-escola">
    </div>
`;


            })
            .catch(() => {
                document.getElementById('info-equip').innerHTML = `
                    <div class="alert alert-danger">Error carregant dades de l'equip.</div>
                `;
            });
    });



    function renderitzarGrafMinuts(noms, minuts) {
        const canvas = document.createElement('canvas');
        canvas.id = 'grafMinuts';
        canvas.classList.add('my-5');
        document.getElementById('grafics-container').appendChild(canvas);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: noms,
                datasets: [{
                    label: 'Minuts jugats',
                    data: minuts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                tooltip: {
                    callbacks: {
                        label: context => {
                            return `${context.dataset.label}: ${Math.round(context.parsed.y)}`;
                        }
                    }
                }
            },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Minuts'
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 90,
                            minRotation: 45,
                            autoSkip: false
                        }
                    }
                }
            }
        });
    }
    </script>


@endsection

