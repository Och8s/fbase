@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/entrenadors/vista.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Benvingut, {{ auth()->user()->name }}</h2>

    <div id="infoEquip" class="mb-4"></div>

    <!-- PARTITS -->
    <div class="mb-5">
        <h4>Partits</h4>
        <div class="mb-3">
            <select id="partitsSelect" class="form-select">
                <option value="">-- Selecciona un partit --</option>
            </select>
        </div>
    </div>

    <!-- ESTADÍSTIQUES EQUIP -->
    <div class="mb-5">
        <a href="#" id="btnEstadisticaEquip" class="btn btn-outline-primary">Estadística Equip</a>
    </div>

    <!-- JUGADORS -->
    <div class="mb-5">
        <h4>Jugadors</h4>
        <div class="row" id="llistatJugadors">
            <!-- Aquí es carregaran els botons dels jugadors -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/equip-del-meu-usuari', {
        credentials: 'include',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(equip => {
        console.log('Equip trobat:', equip);
        if (equip.id) {
            // Mostrar información del equipo
            const infoEquip = document.getElementById('infoEquip');
            infoEquip.innerHTML = `<p><strong>Equip:</strong> ${equip.nom} | <strong>Categoria:</strong> ${equip.categoria}</p>`;

            carregarPartits(equip.id);
            carregarJugadors(equip.id);
            document.getElementById('btnEstadisticaEquip').href = `/vista/equip/${equip.id}`;
        } else {
            alert('No tens cap equip assignat.');
        }
    })
    .catch(error => {
        console.error('Error obtenint l\'equip:', error);
    });
});

function carregarPartits(equipId) {
    fetch(`/api/equips/${equipId}/partits`)
        .then(res => res.json())
        .then(data => {
            const select = document.getElementById('partitsSelect');
            select.innerHTML = '<option value="">-- Selecciona un partit --</option>';

            if (data.length === 0) {
                const option = document.createElement('option');
                option.textContent = 'No hi ha partits disponibles.';
                option.disabled = true;
                select.appendChild(option);
                return;
            }

            data.forEach(partit => {
                const option = document.createElement('option');
                option.value = partit.id;
                option.textContent = `Jornada ${partit.jornada} - ${partit.rival}`;
                select.appendChild(option);
            });

            select.addEventListener('change', function () {
                const partitId = this.value;
                if (partitId) {
                    window.location.href = `/vista/partit/${partitId}`;
                }
            });
        });
}

function carregarJugadors(equipId) {
    fetch(`/api/equips/${equipId}/jugadors`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('llistatJugadors');
            container.innerHTML = '';

            if (data.length === 0) {
                container.innerHTML = '<p>No hi ha jugadors assignats a aquest equip.</p>';
                return;
            }

            data.forEach(jugador => {
                const btn = document.createElement('a');
                btn.href = `/vista/jugadors/${jugador.id}`;
                btn.className = 'btn-jugador';
                btn.innerHTML = `<div class="dorsal">${jugador.dorsal ?? ''}</div><div class="nom">${jugador.nom} ${jugador.cognoms}</div>`;
                container.appendChild(btn);
            });
        });
}
</script>
@endsection
