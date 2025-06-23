@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/entrenadors/jugador.css') }}?v=1.0">
@endsection

@section('content')
<div class="container mt-4">

    <h2 class="mb-0 gradient-text">Estadístiques del jugador</h2>

    {{-- Info del jugador --}}
    <div id="info-jugador" class="alert alert-primary">
        Carregant dades del jugador...
    </div>

    {{-- Taula d'estadístiques --}}
    <h4>Estadístiques per partit</h4>
    <div class="table-responsive">
        <table class="table table-striped" id="taula-estadistiques">
            <thead class="table-dark text-center">
                  <tr>
                    <th rowspan="2">Jornada</th>
                    <th rowspan="2">Partit</th>
                    <th colspan="1">Resultat</th>
                    <th rowspan="2">Jugat a</th> <!-- NOVA COLUMNA -->
                    <th colspan="1">Data</th>
                    <th rowspan="2">Titular</th>
                    <th colspan="1">Minuts</th>
                    <th colspan="1">Gols</th>
                    <th colspan="2">Punts Equip</th>
                    <th colspan="3">Gols Equip</th>
                </tr>
                <tr>
                    <th>Vila - Rival</th>
                    <th>🗓️</th> <!-- sota Data -->
                    <th>⏱</th>  <!-- sota Minuts -->
                    <th>⚽</th>  <!-- sota Gols -->
                    <th>Jug juga</th>
                    <th>Jug al camp</th>
                    <th>GF Jac</th>
                    <th>GC Jac</th>
                    <th>Dif Jac</th>
                </tr>
            </thead>


            <tbody class="text-center">
                {{-- S'omple amb AJAX --}}
            </tbody>
        </table>
    </div>

</div>
<div class="text-center mt-4">
    <a href="{{ url('/vista/entrenador') }}" class="btn btn-gris-suau2">
        🔙 Torna a la vista principal
    </a>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const jugadorId = {{ $jugadorId }};

        fetch(`/api/jugadors/${jugadorId}`)
            .then(response => response.json())
            .then(data => {
                // Mostrar info jugador
                const info = data.jugador;
                const dataNaixement = new Date(info.data_naixement);
                const avui = new Date();
                let edat = avui.getFullYear() - dataNaixement.getFullYear();
                const mes = avui.getMonth() - dataNaixement.getMonth();
                if (mes < 0 || (mes === 0 && avui.getDate() < dataNaixement.getDate())) {
                    edat--;
                }

               document.getElementById('info-jugador').innerHTML = `
    <div class="info-jugador-content d-flex justify-content-between align-items-center flex-wrap">
        <div class="mb-2 mb-md-0">
            <strong>Nom:</strong> ${info.nom} ${info.cognoms}<br>
            <strong>Edat:</strong> ${edat} anys
        </div>
        <img src="/imagesGeneral/logoEscola.png" alt="Logo Escola" class="logo-escola">
    </div>
`;

                const taula = document.querySelector('#taula-estadistiques tbody');
                taula.innerHTML = '';

                data.estadistiques.forEach(est => {
                    const p = est.partit;
                    const jornada = p?.jornada ?? '-';
                    const rival = p?.rival ?? '-';
                    const resultat = (p?.gols_favor ?? '-') + ' - ' + (p?.gols_contra ?? '-');
                    const jugatA = p?.local ? '🏠 Casa' : '🚗 Fora';
                    const dataPartit = p?.data ? new Date(p.data).toLocaleDateString() : '-';

                    taula.innerHTML += `
                        <tr>
                            <td>${jornada}</td>
                            <td>${rival}</td>
                            <td>${resultat}</td>
                            <td>${jugatA}</td> <!-- NOVA CEL·LA -->
                            <td>${dataPartit}</td>
                            <td>${est.titular ? '✔️' : '❌'}</td>
                            <td>${est.minuts_jugats ?? '-'}</td>
                            <td>${est.gols_jugador ?? 0}</td>
                            <td>${est.punts_equip_jjp ?? 0}</td>
                            <td>${est.punts_equip_jec ?? 0}</td>
                            <td>${est.gols_favor_jec ?? 0}</td>
                            <td>${est.gols_contra_jec ?? 0}</td>
                            <td>${est.dif_gols_jec ?? 0}</td>
                        </tr>
                    `;
                });
            })
            .catch(error => {
                document.getElementById('info-jugador').innerHTML = `
                    <div class="alert alert-danger">Error carregant dades del jugador.</div>
                `;
                console.error('Error carregant dades:', error);
            });
    });
</script>
@endsection
