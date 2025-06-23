@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Jugadors associats a tu</h2>
    <div id="missatge" class="alert alert-info">Carregant jugadors...</div>
    <div class="row" id="llistatJugadors"></div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/tutor/jugadors')
        .then(res => res.json())
        .then(jugadors => {
            const missatge = document.getElementById('missatge');
            const container = document.getElementById('llistatJugadors');

            if (!jugadors || jugadors.length === 0) {
                missatge.className = 'alert alert-warning';
                missatge.innerText = 'No tens cap jugador associat.';
                return;
            }

            if (jugadors.length === 1) {
                // Redirigeix automàticament si només hi ha un fill
                window.location.href = `/vista/jugador/${jugadors[0].id}`;
                return;
            }

            missatge.remove();

            jugadors.forEach(jugador => {
                const card = document.createElement('div');
                card.className = 'col-md-4 mb-3';
                card.innerHTML = `
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">${jugador.nom} ${jugador.cognoms}</h5>
                            <p class="card-text">Data naixement: ${jugador.data_naixement}</p>
                            <a href="/vista/jugador/${jugador.id}" class="btn btn-primary">Veure estadístiques</a>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        })
        .catch(err => {
            console.error(err);
            document.getElementById('missatge').innerText = 'Error carregant les dades.';
        });
});
</script>
@endsection
