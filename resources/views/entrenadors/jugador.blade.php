@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Estadístiques del jugador</h2>

    {{-- Info del jugador --}}
    <div id="info-jugador" class="alert alert-primary">
        Carregant dades del jugador...
    </div>

    {{-- Taula de partits amb estadístiques --}}
    <h4>Estadístiques per partit</h4>
    <table class="table table-striped" id="taula-estadistiques">
        <thead class="table-dark">
            <tr>
                <th>Partit</th>
                <th>Data</th>
                <th>Titular</th>
                <th>Minuts</th>
                <th>Gols</th>
                <th>Punts</th>
            </tr>
        </thead>
        <tbody>
            {{-- S'omple amb AJAX --}}
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const jugadorId = {{ $jugadorId }}; // Variable que reps des del controlador Blade

        fetch(`/api/jugadors/${jugadorId}`)
            .then(response => response.json())
            .then(data => {
                // Info del jugador
                const info = data.jugador;
                document.getElementById('info-jugador').innerHTML = `
                    <strong>Nom:</strong> ${info.nom} ${info.cognoms}<br>
                    <strong>Data de naixement:</strong> ${info.data_naixement}
                `;

                // Taula d'estadístiques
                const taula = document.querySelector('#taula-estadistiques tbody');
                data.estadistiques.forEach(est => {
                    const row = `
                        <tr>
                            <td>${est.partit?.rival ?? '-'}</td>
                            <td>${est.partit?.data ?? '-'}</td>
                            <td>${est.titular ? '✔️' : '❌'}</td>
                            <td>${est.minuts_jugats ?? '-'}</td>
                            <td>${est.gols_jugador ?? 0}</td>
                            <td>${est.punts_equip_jjp ?? 0}</td>
                        </tr>
                    `;
                    taula.innerHTML += row;
                });
            })
            .catch(error => {
                document.getElementById('info-jugador').innerHTML = `<div class="alert alert-danger">Error carregant dades del jugador.</div>`;
                console.error('Error:', error);
            });
    });
</script>
@endsection

{{-- L’usuari (entrenador) accedeix a:
http://localhost:8000/vista/jugadors/3

Laravel carrega la vista jugador.blade.php i li passa el id del jugador

Quan es carrega la pàgina, es fa una crida AJAX a:
/api/jugadors/3
(ruta API protegida per isEntrenador)

Es mostren les dades del jugador i una taula amb estadístiques per partit  --}}
