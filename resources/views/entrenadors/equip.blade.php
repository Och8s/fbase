<!-- resources/views/entrenadors/equip.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Estadístiques de l'equip</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jugador</th>
                    <th>Partits jugats</th>
                    <th>Titularitats</th>
                    <th>Minuts jugats</th>
                    <th>Gols</th>
                    <th>Punts JJP</th>
                    <th>Punts JEC</th>
                    <th>Gols favor JEC</th>
                    <th>Gols contra JEC</th>
                    <th>Diferència gols</th>
                </tr>
            </thead>
            <tbody id="taulaEstadistiques">
                <!-- Dades carregades via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const equipId = window.location.pathname.split('/').pop();

    document.addEventListener("DOMContentLoaded", function () {
        fetch(`/api/equips/${equipId}/jugadors`)
            .then(res => res.json())
            .then(jugadors => {
                const taula = document.getElementById("taulaEstadistiques");
                taula.innerHTML = "";

                jugadors.forEach(jugador => {
                    fetch(`/api/jugadors/${jugador.id}`) // vistaEntrenador (estadístiques)
                        .then(res => res.json())
                        .then(data => {
                            const estadistiques = data.estadistiques;

                            const partitsJugats = estadistiques.filter(e => e.partido_jugado).length;
                            const titulars = estadistiques.filter(e => e.titular).length;
                            const minuts = estadistiques.reduce((acc, e) => acc + (e.minuts_jugats || 0), 0);
                            const gols = estadistiques.reduce((acc, e) => acc + (e.gols_jugador || 0), 0);
                            const puntsJJP = estadistiques.reduce((acc, e) => acc + (e.punts_equip_jjp || 0), 0);
                            const puntsJEC = estadistiques.reduce((acc, e) => acc + (e.punts_equip_jec || 0), 0);
                            const favorJEC = estadistiques.reduce((acc, e) => acc + (e.gols_favor_jec || 0), 0);
                            const contraJEC = estadistiques.reduce((acc, e) => acc + (e.gols_contra_jec || 0), 0);
                            const dif = estadistiques.reduce((acc, e) => acc + (e.dif_gols_jec || 0), 0);

                            const fila = document.createElement('tr');
                            fila.innerHTML = `
                                <td>${jugador.nom} ${jugador.cognoms}</td>
                                <td>${partitsJugats}</td>
                                <td>${titulars}</td>
                                <td>${minuts}</td>
                                <td>${gols}</td>
                                <td>${puntsJJP}</td>
                                <td>${puntsJEC}</td>
                                <td>${favorJEC}</td>
                                <td>${contraJEC}</td>
                                <td>${dif}</td>
                            `;
                            taula.appendChild(fila);
                        });
                });
            });
    });
</script>
@endsection
