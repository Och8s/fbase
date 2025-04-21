@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Resum d'estadístiques del teu fill/a</h2>

    <div id="info-jugador" class="alert alert-primary">Carregant dades del jugador...</div>

    <div id="resum" class="row g-3">
        {{-- Aquí s'omplirà amb targetes Bootstrap --}}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const jugadorId = {{ $jugadorId }};

        fetch(`/api/jugador/${jugadorId}`)
            .then(res => res.json())
            .then(data => {
                const jugador = data.jugador;
                const resum = data.resum;

                // Mostra info bàsica del jugador
                document.getElementById('info-jugador').innerHTML = `
                    <strong>Nom:</strong> ${jugador.nom} ${jugador.cognoms}<br>
                    <strong>Data de naixement:</strong> ${jugador.data_naixement}
                `;

                // Targetes amb dades resumides
                const container = document.getElementById('resum');
                container.innerHTML = `
                    <div class="col-md-6">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">Mitjanes de punts</div>
                            <div class="card-body">
                                <p>Quan participa: <strong>${resum.mitjana_punts_presencia}</strong></p>
                                <p>Quan és titular: <strong>${resum.mitjana_punts_titular}</strong></p>
                                <p>Quan està al camp: <strong>${resum.mitjana_punts_camp}</strong></p>
                                <p>Equip en general: <strong>${resum.mitjana_punts_equip}</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">Gols i minuts</div>
                            <div class="card-body">
                                <p>Gols marcats: <strong>${resum.gols_jugador}</strong></p>
                                <p>Gol cada: <strong>${resum.minuts_per_gol ?? '-'}</strong> minuts</p>
                                <p>Gols equip amb ell al camp: <strong>${resum.gols_favor_jec}</strong></p>
                                <p>Gols rebuts amb ell al camp: <strong>${resum.gols_contra_jec}</strong></p>
                                <p>Diferència de gols: <strong>${resum.dif_gols_jec}</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border-dark">
                            <div class="card-header bg-dark text-white">Comparativa gols per partit</div>
                            <div class="card-body">
                                <p>⚽ Amb ell al camp: <strong>${resum.mitjana_gols_partit_amb}</strong> gols marcats</p>
                                <p>⚽ Sense ell al camp: <strong>${resum.mitjana_gols_partit_sense}</strong> gols marcats</p>
                                <p>❌ Amb ell al camp: <strong>${resum.mitjana_gols_rebuts_amb}</strong> gols rebuts</p>
                                <p>❌ Sense ell al camp: <strong>${resum.mitjana_gols_rebuts_sense}</strong> gols rebuts</p>
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error carregant dades del jugador tutor:', error);
                document.getElementById('info-jugador').innerHTML =
                    `<div class="alert alert-danger">Error carregant dades del jugador.</div>`;
            });
    });
</script>
@endsection
