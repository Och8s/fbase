@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/entrenadors/vista.css') }}?v={{ time() }}">
@endsection

@section('content')

<div class="container mt-4">
    {{-- <h2 class="mb-4">Benvingut, {{ auth()->user()->name }} </h2> --}}

<div id="infoEquip" class="info-equip-box d-flex align-items-center justify-content-start gap-3 mb-4">
    <h3 id="infoEquipText" class="gradient-text mb-0"></h3>
          <img src="{{ asset('imagesGeneral/logoEscola.png') }}" alt="Logo Escola" class="logo-escola">
</div>


        <!-- CONTENEDOR PRINCIPAL -->
    <div class="d-flex justify-content-between align-items-start mb-5">
        <!-- JUGADORS -->
        <div class="jugadors-container">
            <h4>Jugadors</h4>
            <div class="row" id="llistatJugadors">
                <!-- Aquí se cargarán los botones de los jugadores -->
            </div>
        </div>

        <!-- PARTITS I ESTADÍSTIQUES -->
        <div class="partits-container" style="width: 25%;">
            <div class="text-center w-100">
                <h4>Ingresar partits</h4>
                <div class="mb-3">
                    <select id="partitsSelect" class="form-select partit-select mx-auto">
    <option value="">-- Selecciona un partit --</option>
</select>

                </div>

                <div>
                    <a href="#" id="btnEstadisticaEquip" class="btn btn-secondary mb-5">Estadístiques Equip</a>

                </div>
                <div id="formEnviarInformesContainer"></div>

            </div>
        </div>

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
document.getElementById('infoEquipText').textContent = ` ${equip.nom} |  ${equip.categoria}`;

            carregarPartits(equip.id);
            carregarJugadors(equip.id);
            document.getElementById('btnEstadisticaEquip').href = `/vista/equip/${equip.id}`;
        } else {
            alert('No tens cap equip assignat.');
        }
       // Crear el formulari per enviar informes
        const formContainer = document.getElementById('formEnviarInformesContainer');
        formContainer.innerHTML = `
    <div class="text-center">
    <form action="/enviar-informes/equip/${equip.id}" method="POST" id="formEnviarInformes">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button id="btnEnviarInformes" type="button" class="btn-enviar-informes">
    <span class="emoji">📧</span>
    <span class="text">Enviar Informes</span>
</button>

    </form>
</div>
`;



            })
    .catch(error => {
        console.error('Error obtenint l\'equip:', error);
    });
});

document.addEventListener("click", function (e) {
    if (e.target && e.target.id === "btnEnviarInformes") {
        Swal.fire({
            title: "Segur que vols enviar els informes individualitzats?",
            html: "Cada tutor rebrà l’informe del jugador/a al seu càrrec.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, enviar!",
            cancelButtonText: "Cancel·la"
        }).then((result) => {
            if (result.isConfirmed) {
                const boto = document.getElementById("btnEnviarInformes");
                boto.disabled = true;
                boto.innerHTML = "Enviant... ⏳";
                document.getElementById("formEnviarInformes").submit();
            }
        });
    }
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
btn.innerHTML = `
  <div class="dorsal">${jugador.dorsal ?? ''}</div>
  <div class="nom">${jugador.nom}</div>
  <div class="cognoms">${jugador.cognoms}</div>
`;
                container.appendChild(btn);
            });
        });
}


</script>
@endsection
