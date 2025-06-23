@extends('layouts.app')
{{-- javi --}}

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/entrenadors/partit.css') }}?v=1.0">
@endsection
@section('content')
<div class="container mt-4" id="info-partit">
    <div id="titolLogoContainer">
        <img src="{{ asset('imagesGeneral/logoEscola.png') }}" alt="Logo Escola" class="logo-escola">
        <h4 id="titolPartit" class="mb-0 gradient-text"></h4>
    </div>
</div>


<!-- INFORMACIÓ DEL PARTIT -->
<div id="infoPartit">
    <h4>Dades generals del partit</h4>
    <div class="mb-3">
    <label class="form-label">Durada del partit (minuts)</label>
    <input type="number" id="duradaPartitInput" class="form-control" min="60" max="120" value="">
</div>


    <!-- Primera fila: Gols -->
    <div class="row mb-3" id="blocGols">
        <p class="negreta">Resultat</p>
                <div class="col-md-6">
            <label class="form-label">Gols a favor</label>
            <input type="number" id="golsFavor" class="form-control" min="0" max="25">
            <div id="inputsGolsFavor" class="mt-2"></div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Gols en contra</label>
            <input type="number" id="golsContra" class="form-control" min="0" max="25">
            <div id="inputsGolsContra" class="mt-2"></div>
        </div>
    </div>

    <!-- Segona fila: Canvis i Expulsions -->
    <div class="row" id="blocInferior">
        <p class="negreta">Incidències</p>
        <div class="col-md-4">
            <label class="form-label">Canvis</label>
            <input type="number" id="canvis" class="form-control" min="0" max="20">
            <div id="inputsCanvis" class="mt-2"></div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Expulsions</label>
            <input type="number" id="expulsions" class="form-control" min="0" max="8">
            <div id="inputsExpulsions" class="mt-2"></div>
        </div>
    </div>


    <!-- TAULA DE JUGADORS -->
    <div class="mt-5" id="taulaJugadorsEstadistiques">
        <h4>Estadístiques dels jugadors</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">Jugador</th>
                        <th rowspan="2">Jugat</th>
                        <th rowspan="2">Titular</th>
                        <th rowspan="2">Gols ⚽</th>
                        <th rowspan="2">Expulsió 🟥</th>
                        <th rowspan="2">Minuts ⏱</th>
                        <th colspan="2">Punts Equip</th>
                        <th colspan="3">Gols Equip</th>
                    </tr>
                    <tr>
                        <th>Jug juga</th>
                        <th>Jug al camp</th>
                        <th>GF Jac</th>
                        <th>GC Jac</th>
                        <th>Dif Jac</th>
                    </tr>
                </thead>


                <tbody id="cosTaulaJugadors"></tbody>
            </table>
        </div>
    </div>
     <!-- Fora de la .row per evitar límits de columnes -->
     <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-end">
            <div id="resumEstat" class="alert alert-info d-inline-block mb-0">
                Titulars: 0 | Minuts totals: 0
            </div>
        </div>
        <div class="flex-grow-1 text-center">
            <button id="guardarEstadistiques" class="btn btn-success">💾 Guardar dades</button>
        </div>
    </div>

</div>
<div class="text-end mt-4 marges-laterals">
    <a href="{{ url('/vista/entrenador') }}" class="btn btn-gris-suau2 me-3">
        🔙 Torna a la vista principal
    </a>
</div>

@endsection
{{-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX script XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX --}}

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const partitId = window.location.pathname.split('/').pop();
    let jugadorsEquip = [];
    let minutsJugats = {};

    let duradaPartit ;
    const duradaPartitInput = document.getElementById('duradaPartitInput');

    duradaPartitInput.addEventListener('input', () => {
    const valor = parseInt(duradaPartitInput.value);
    if (!isNaN(valor)) {
        duradaPartit = valor;
        actualitzaGolsJugadorEnCamp();   // Recalcula intervals, minuts, gols en camp...
        actualitzaPEQJJP();              // Recalcula punts equip si ha jugat
        actualitzaResumEstat();          // Actualitza el resum de titulars i minuts
    }
});


    const golsFavor = document.getElementById('golsFavor');
    const golsContra = document.getElementById('golsContra');
    const canvis = document.getElementById('canvis');

    const inputsGolsFavor = document.getElementById('inputsGolsFavor');
    const inputsGolsContra = document.getElementById('inputsGolsContra');
    const inputsCanvis = document.getElementById('inputsCanvis');

    const expulsions = document.getElementById('expulsions');
    const inputsExpulsions = document.getElementById('inputsExpulsions');


    fetch('/sanctum/csrf-cookie', { credentials: 'include' }).then(() => {
        fetch(`/api/partits/${partitId}`, {
            credentials: 'include',
            headers: { 'Accept': 'application/json' }
        })
        .then(res => {
            if (!res.ok) throw new Error('Error de xarxa o no autoritzat');
            return res.json();
        })
        .then(data => {
            document.getElementById('titolPartit').textContent = `Jornada ${data.jornada} - ${data.rival}`;
            document.getElementById('golsFavor').value = data.gols_favor;
            document.getElementById('golsContra').value = data.gols_contra;

            if (data.equip_id) {
                carregarJugadors(data.equip_id);
            }
        })
        .catch(error => console.error('Error carregant dades del partit:', error));
    });

    function carregarJugadors(equipId) {
        fetch(`/api/equips/${equipId}/jugadors`, {
            credentials: 'include',
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            jugadorsEquip = data;
            const cosTaula = document.getElementById('cosTaulaJugadors');
            cosTaula.innerHTML = '';
            minutsJugats = {};

            // Ordena jugadors per dorsal (numèric)
            jugadorsEquip.sort((a, b) => {
                // Si algun no té dorsal, el posem al final
                if (!a.dorsal) return 1;
                if (!b.dorsal) return -1;
                return a.dorsal - b.dorsal;
            });


            jugadorsEquip.forEach(j => {
    minutsJugats[j.id] = 0;

    const fila = document.createElement('tr');
    fila.innerHTML = `
<td>${j.dorsal ? j.dorsal + ' ' : ''}${j.nom}</td>
        <td><input type="checkbox" name="jugador_${j.id}_j" class="form-check-input" /></td>
        <td><input type="checkbox" name="jugador_${j.id}_t" class="form-check-input titular-checkbox" data-id="${j.id}" /></td>
        <td><input type="number" name="jugador_${j.id}_gols" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_expulsio" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_minuts" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_jjp" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_jec" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_gfjec" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_gcjec" class="form-control" readonly /></td>
        <td><input type="number" name="jugador_${j.id}_dif" class="form-control" readonly /></td>
    `;
    cosTaula.appendChild(fila);

    // AFEGIT: actualització PEQ JJP quan es marca/desmarca "J"
    const jCheckbox = fila.querySelector(`[name="jugador_${j.id}_j"]`);
    if (jCheckbox) {
        jCheckbox.addEventListener('change', () => {
            actualitzaPEQJJP();
            actualitzaResumEstat(); // <- Aquí és on vols actualitzar també el resum
        });
    }


});
actualitzaResumEstat();
        // FASE 2: Recol·lectar dades dels jugadors ******

        // CHECK BOX TITULARITAT
        // Recorrem tots els checkbox de titularitat (classe .titular-checkbox)
        document.querySelectorAll('.titular-checkbox').forEach(cb => {
            // Afegim un event listener per quan es marca o desmarca el checkbox
            cb.addEventListener('change', function () {
                const id = this.dataset.id; // Obtenim l'ID del jugador des del data-id del checkbox
                const jugatCb = document.querySelector(`[name="jugador_${id}_j"]`); // Checkbox de "jugat" (J)
                const minutsInput = document.querySelector(`[name="jugador_${id}_minuts"]`); // Input de minuts jugats
                if (this.checked) {   // Si el jugador es marca com a titular...
                    if (!jugatCb.checked) jugatCb.checked = true; // ...automàticament també es marca com a "jugat"
                    minutsJugats[id] += duradaPartit ; // S’afegeixen 95 minuts al total del jugador
                } else {            // Si es desmarca com a titular...
                    minutsJugats[id] -= duradaPartit ; // ...se li resten els 95 minuts
                }
                // S’actualitza el camp visual de minuts jugats
                if (minutsInput) minutsInput.value = minutsJugats[id];
                // Recalcula els punts PEQ JJP (punts de l’equip si el jugador ha jugat)
                actualitzaPEQJJP();
                // Torna a calcular les estadístiques en base als minuts jugats (gols en camp, diferència, etc.)
                actualitzaGolsJugadorEnCamp();
                // Actualitza Titulars y minuts
                actualitzaResumEstat();

            });
        });


        })
        .catch(error => {
            console.error('Error carregant jugadors de l\'equip:', error);
        });
    }

  // FUNCIO PER OMPLIR DESPLEGABLES
  function crearSelectJugadors(name, afegirOpcioEspecial = true, textDefault = '-- Selecciona jugador --', textOpcioEspecial = '⚽ Opció especial') {
    const select = document.createElement('select');
    select.name = name;
    select.className = 'form-control';

    // Placeholder inicial
    const optDefault = document.createElement('option');
    optDefault.value = '';
    optDefault.textContent = textDefault;
    select.appendChild(optDefault);

    // Opció especial (si es vol afegir)
    if (afegirOpcioEspecial) {
        const optEspecial = document.createElement('option');
        optEspecial.value = 'null';
        optEspecial.textContent = textOpcioEspecial;
        select.appendChild(optEspecial);
    }

    // Jugadors
    jugadorsEquip.forEach(j => {
        const opt = document.createElement('option');
        opt.value = j.id;
        opt.textContent = j.nom + (j.dorsal ? ` (#${j.dorsal})` : '');
        select.appendChild(opt);
    });

    return select;
}


    golsFavor.addEventListener('change', function () { // GOLS A FAVOR
        const count = parseInt(this.value) || 0;

        // Reset
        jugadorsEquip.forEach(j => {
            const inputGol = document.querySelector(`[name="jugador_${j.id}_gols"]`);
            if (inputGol) inputGol.value = 0;
        });

        inputsGolsFavor.innerHTML = '';
        const seleccionats = [];

        for (let i = 0; i < count; i++) {
    const bloc = document.createElement('div');
    bloc.classList.add('mb-2');
    bloc.innerHTML = `
        <label>Gol ${i + 1} - Minut:</label>
        <input type="number" name="gol_favor_minut_${i}" class="form-control mb-1" min="1" max="105" />
        <label>Jugador:</label>
    `;

    // 🔍 Aquí busquem el input que hem generat dins del bloc
    const inputMinut = bloc.querySelector(`[name="gol_favor_minut_${i}"]`);
    inputMinut.addEventListener('change', () => {
        actualitzaGolsJugadorEnCamp();
    });

    const select = crearSelectJugadors(`gol_favor_jugador_${i}`, true, '-- Selecciona Jugador --', '⚠️ Pròpia porta');
    bloc.appendChild(select);
    inputsGolsFavor.appendChild(bloc);

    seleccionats[i] = null;
    select.addEventListener('change', () => {
        const nouId = select.value;
        const anteriorId = seleccionats[i];

        if (anteriorId && anteriorId !== 'null') {
            const inputAntic = document.querySelector(`[name="jugador_${anteriorId}_gols"]`);
            if (inputAntic && inputAntic.value > 0) {
                inputAntic.value = parseInt(inputAntic.value) - 1;
            }
        }

        if (nouId && nouId !== 'null') {
            const inputNou = document.querySelector(`[name="jugador_${nouId}_gols"]`);
            if (inputNou) {
                inputNou.value = parseInt(inputNou.value || 0) + 1;
            }
        }

        seleccionats[i] = nouId;
        actualitzaGolsJugadorEnCamp(); // També aquí!
    });
}

        actualitzaPEQJJP();
        actualitzaGolsJugadorEnCamp();

    }); // FI GOLS A FAVOR

    golsContra.addEventListener('change', function () { // GOLS EN CONTRA
    const count = parseInt(this.value) || 0;
    inputsGolsContra.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const bloc = document.createElement('div');
            bloc.classList.add('mb-2');
            bloc.innerHTML = `
                <label>Gol en contra ${i + 1} - Minut:</label>
                <input type="number" name="gol_contra_minut_${i}" class="form-control" min="1" max="105" />
            `;
            inputsGolsContra.appendChild(bloc);

            const inputMinut = bloc.querySelector(`[name="gol_contra_minut_${i}"]`);
            inputMinut.addEventListener('change', () => {
                actualitzaGolsJugadorEnCamp();
            });
        }
        actualitzaPEQJJP();
        actualitzaGolsJugadorEnCamp();
    }); // FI GOLES EN CONTRA


    canvis.addEventListener('change', function () {
    const count = parseInt(this.value) || 0;
    inputsCanvis.innerHTML = '';

    // 🧹 Reset de minuts jugats
    jugadorsEquip.forEach(j => {
        const id = j.id;
        minutsJugats[id] = document.querySelector(`[name="jugador_${id}_t"]`).checked ? duradaPartit  : 0;
        const inputMinuts = document.querySelector(`[name="jugador_${id}_minuts"]`);
        if (inputMinuts) inputMinuts.value = minutsJugats[id];
    });

    for (let i = 0; i < count; i++) {
        const bloc = document.createElement('div');
        bloc.classList.add('mb-2');
        bloc.innerHTML = `<label>Canvi ${i + 1}</label>`;
        const row = document.createElement('div');
        row.classList.add('row');

        const col1 = document.createElement('div');
        col1.classList.add('col-md-4');
        const inputMinut = document.createElement('input');
        inputMinut.type = 'number';
        inputMinut.name = `canvi_minut_${i}`;
        inputMinut.className = 'form-control';
        inputMinut.placeholder = 'Minut';
        inputMinut.min = 1;
        inputMinut.max = 105;
        col1.appendChild(inputMinut);

        const col2 = document.createElement('div');
        col2.classList.add('col-md-4');
        const selectSurt = crearSelectJugadors(`canvi_surt_${i}`, false, '-- Surt --');
        col2.appendChild(selectSurt);


        const col3 = document.createElement('div');
        col3.classList.add('col-md-4');
        const selectEntra = crearSelectJugadors(`canvi_entra_${i}`, true, '-- Entra --', '🙅 Sense substitut');
        col3.appendChild(selectEntra);

        row.appendChild(col1);
        row.appendChild(col2);
        row.appendChild(col3);
        bloc.appendChild(row);
        inputsCanvis.appendChild(bloc);

        let anteriorSurt = null;
        let anteriorSumaSurt = 0;

        let anteriorEntra = null;
        let anteriorSumaEntra = 0;

        function actualitzaMinuts(id, diferència) {
            if (!id || id === 'null') return;
            minutsJugats[id] += diferència;
            const inputMinuts = document.querySelector(`[name="jugador_${id}_minuts"]`);
            if (inputMinuts) inputMinuts.value = minutsJugats[id];
        }

        function gestionaSurt() {
            const nouId = selectSurt.value;
            const minut = parseInt(inputMinut.value);

            if (anteriorSurt && anteriorSumaSurt) {
                actualitzaMinuts(anteriorSurt, anteriorSumaSurt); // recuperem el que vam restar
            }

            if (nouId && nouId !== 'null' && minut) {
                const suma = -(duradaPartit  - minut); // restem minuts jugats
                actualitzaMinuts(nouId, suma);
                anteriorSurt = nouId;
                anteriorSumaSurt = -suma;
            } else {
                anteriorSurt = null;
                anteriorSumaSurt = 0;
            }
        }

        function gestionaEntra() {
            const nouId = selectEntra.value;
            const minut = parseInt(inputMinut.value);

            if (anteriorEntra && anteriorSumaEntra) {
                actualitzaMinuts(anteriorEntra, -anteriorSumaEntra); // traiem el que havíem sumat
            }

            if (nouId && nouId !== 'null' && minut) {
                const suma = duradaPartit  - minut;
                actualitzaMinuts(nouId, suma);
                anteriorEntra = nouId;
                anteriorSumaEntra = suma;
            } else {
                anteriorEntra = null;
                anteriorSumaEntra = 0;
            }
        }

        inputMinut.addEventListener('change', () => {
            gestionaSurt();
            gestionaEntra();
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
            actualitzaResumEstat();

        });

        selectSurt.addEventListener('change', () => {
            gestionaSurt();
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
            actualitzaResumEstat();

        });

        selectEntra.addEventListener('change', () => {
            gestionaEntra();
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
            actualitzaResumEstat();

        });
    }

    actualitzaGolsJugadorEnCamp();
    actualitzaResumEstat();

});

//   hhh
expulsions.addEventListener('change', function () {
    const count = parseInt(this.value) || 0;
    inputsExpulsions.innerHTML = '';

    // 🧹 Reseteja minuts i expulsions
    jugadorsEquip.forEach(j => {
        const id = j.id;
        const tCheck = document.querySelector(`[name="jugador_${id}_t"]`);
        const minutsBase = tCheck && tCheck.checked ? duradaPartit  : 0;
        minutsJugats[id] = minutsBase;

        const inputMinuts = document.querySelector(`[name="jugador_${id}_minuts"]`);
        const inputExp = document.querySelector(`[name="jugador_${id}_expulsio"]`);
        if (inputMinuts) inputMinuts.value = minutsBase;
        if (inputExp) inputExp.value = '';
    });

    for (let i = 0; i < count; i++) {
        const bloc = document.createElement('div');
        bloc.classList.add('mb-2');
        bloc.innerHTML = `<label>Expulsió ${i + 1}</label>`;
        const row = document.createElement('div');
        row.classList.add('row');

        const col1 = document.createElement('div');
        col1.classList.add('col-md-6');
        const inputMinut = document.createElement('input');
        inputMinut.type = 'number';
        inputMinut.name = `expulsio_minut_${i}`;
        inputMinut.className = 'form-control';
        inputMinut.placeholder = 'Minut';
        inputMinut.min = 1;
        inputMinut.max = 105 ;
        col1.appendChild(inputMinut);

        const col2 = document.createElement('div');
        col2.classList.add('col-md-6');
        const selectJugador = crearSelectJugadors(`expulsio_jugador_${i}`, false, '-- Selecciona jugador --');
        col2.appendChild(selectJugador);

        row.appendChild(col1);
        row.appendChild(col2);
        bloc.appendChild(row);
        inputsExpulsions.appendChild(bloc);

        // 🔁 Sempre que canviï el minut o el jugador, actualitza intervals i minuts
        inputMinut.addEventListener('change', () => {
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
            actualitzaResumEstat(); // ✅ AFEGIT

        });

        selectJugador.addEventListener('change', () => {
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
            actualitzaResumEstat(); // ✅ AFEGIT

        });
    }

    // Força actualització després de generar les expulsions
    actualitzaGolsJugadorEnCamp();
    actualitzaResumEstat();

});


function actualitzaPEQJJP() {
    const gf = parseInt(golsFavor.value);
    const gc = parseInt(golsContra.value);
    let punts = '';

    if (!isNaN(gf) && !isNaN(gc)) {
        if (gf > gc) punts = 3;
        else if (gf === gc) punts = 1;
        else punts = 0;
    }

    jugadorsEquip.forEach(j => {
        const jCheckbox = document.querySelector(`[name="jugador_${j.id}_j"]`);
        const inputJJP = document.querySelector(`[name="jugador_${j.id}_jjp"]`);

        if (jCheckbox && inputJJP) {
            if (jCheckbox.checked) {
                inputJJP.value = punts;
            } else {
                inputJJP.value = '';
            }
        }
    });
}

function actualitzaGolsJugadorEnCamp() {
    const intervalsJugador = {};
    const numCanvis = parseInt(canvis.value) || 0;

    // 🔁 Reiniciem intervals i minuts jugats
    jugadorsEquip.forEach(j => {
        const id = j.id;
        minutsJugats[id] = 0;
        const intervals = [];

        // Titularitat
        if (document.querySelector(`[name="jugador_${id}_t"]`)?.checked) {
            intervals.push([1, duradaPartit ]);
            minutsJugats[id] = duradaPartit ;
        }

        // Canvis
        for (let i = 0; i < numCanvis; i++) {
            const minut = parseInt(document.querySelector(`[name="canvi_minut_${i}"]`)?.value);
            const entra = document.querySelector(`[name="canvi_entra_${i}"]`)?.value;
            const surt = document.querySelector(`[name="canvi_surt_${i}"]`)?.value;

            if (!isNaN(minut)) {
                if (surt == id) {
                    const last = intervals.find(int => int[1] === duradaPartit);
                    if (last) last[1] = minut;
                    minutsJugats[id] -= (duradaPartit  - minut);
                }

                if (entra == id) {
                    const inici = minut + 1;
                    if (inici <= duradaPartit ) {
                        intervals.push([inici, duradaPartit ]);
                        minutsJugats[id] += (duradaPartit  - inici + 1);
                    }
                }

            }
        }

        intervalsJugador[id] = intervals;

        // Refresquem minut jugat a la taula
        const inputMinuts = document.querySelector(`[name="jugador_${id}_minuts"]`);
        if (inputMinuts) inputMinuts.value = minutsJugats[id];
    });

    // 🔴 Expulsions — afecten intervals
    const numExpulsions = parseInt(expulsions.value) || 0;
    for (let i = 0; i < numExpulsions; i++) {
        const minutExp = parseInt(document.querySelector(`[name="expulsio_minut_${i}"]`)?.value);
        const jugadorExp = document.querySelector(`[name="expulsio_jugador_${i}"]`)?.value;

        if (!isNaN(minutExp) && jugadorExp) {
            const intervals = intervalsJugador[jugadorExp];
            const last = intervals?.find(int => int[1] === duradaPartit );
            if (last && minutExp < last[1]) {
                last[1] = minutExp ;

                // Recalcular minuts jugats
                const suma = last[1] - last[0] + 1;
                minutsJugats[jugadorExp] = intervals.reduce((acc, [inici, fi]) => acc + (fi - inici + 1), 0);

                const inputMinuts = document.querySelector(`[name="jugador_${jugadorExp}_minuts"]`);
                if (inputMinuts) inputMinuts.value = minutsJugats[jugadorExp];

                const inputExp = document.querySelector(`[name="jugador_${jugadorExp}_expulsio"]`);
                if (inputExp) inputExp.value = 1;
            }
        }
    }

    // ⚽️ Gols a favor i en contra
    const golsFavorMinuts = [];
    const golsContraMinuts = [];

    for (let i = 0; i < parseInt(golsFavor.value) || 0; i++) {
        const m = parseInt(document.querySelector(`[name="gol_favor_minut_${i}"]`)?.value);
        if (!isNaN(m)) golsFavorMinuts.push(m);
    }

    for (let i = 0; i < parseInt(golsContra.value) || 0; i++) {
        const m = parseInt(document.querySelector(`[name="gol_contra_minut_${i}"]`)?.value);
        if (!isNaN(m)) golsContraMinuts.push(m);
    }

    // 🧮 Comptem gols en camp
    jugadorsEquip.forEach(j => {
        const id = j.id;
        const intervals = intervalsJugador[id] || [];
        let favor = 0, contra = 0;

        golsFavorMinuts.forEach(min => {
            if (intervals.some(([ini, fi]) => min >= ini && min <= fi)) favor++;
        });

        golsContraMinuts.forEach(min => {
            if (intervals.some(([ini, fi]) => min >= ini && min <= fi)) contra++;
        });

        document.querySelector(`[name="jugador_${id}_gfjec"]`).value = favor;
        document.querySelector(`[name="jugador_${id}_gcjec"]`).value = contra;
        document.querySelector(`[name="jugador_${id}_dif"]`).value = favor - contra;
        const inputPEQJEC = document.querySelector(`[name="jugador_${id}_jec"]`);

        // Li otorguem els punts necesaris segons la diferencia de gols jugador al camp
        if (inputPEQJEC) {
            if (favor - contra > 0) inputPEQJEC.value = 3;
            else if (favor - contra < 0) inputPEQJEC.value = 0;
            else inputPEQJEC.value = 1;
        }

    });
}

function actualitzaResumEstat() {
    let titulars = 0;
    let minutsTotals = 0;

    jugadorsEquip.forEach(j => {
        const t = document.querySelector(`[name="jugador_${j.id}_t"]`);
        const m = document.querySelector(`[name="jugador_${j.id}_minuts"]`);
        if (t?.checked) titulars++;
        if (m?.value) minutsTotals += parseInt(m.value) || 0;
    });

    const resum = document.getElementById('resumEstat');

    // ❌ Elimina qualsevol classe de color anterior
    resum.classList.remove('alert-info', 'alert-danger', 'alert-success');

if (titulars === 11 && minutsTotals === (11 * duradaPartit)) {
        resum.classList.add('alert-success');
        resum.textContent = `Titulars: ${titulars} | Minuts totals: ${minutsTotals} 🆗`;
    } else {
        resum.classList.add('alert-danger');
        resum.textContent = `⚠️ Titulars: ${titulars} | Minuts totals: ${minutsTotals}`;
    }
}





//*******************************************************************************


document.getElementById('guardarEstadistiques').addEventListener('click', async () => {
    const valid = await validaFormulari();
    if (valid) {
        await guardarDades();
    }
});

async function validaFormulari() {
    const numGolsFavor = parseInt(golsFavor.value) || 0;
    const numGolsContra = parseInt(golsContra.value) || 0;
    const numCanvis = parseInt(canvis.value) || 0;
    const numExpulsions = parseInt(expulsions.value) || 0;

    // Validar gols a favor
    for (let i = 0; i < numGolsFavor; i++) {
        const minut = document.querySelector(`[name="gol_favor_minut_${i}"]`)?.value;
        const jugador = document.querySelector(`[name="gol_favor_jugador_${i}"]`)?.value;
            if (!minut || minut <= 0 || minut > duradaPartit || !jugador) {

            await Swal.fire({
                icon: 'warning',
                title: 'Dades incompletes',
            text: `⚠️ Gol a favor ${i + 1}: falta el jugador, el minut o el minut és massa alt.`,
                confirmButtonText: 'OK'
            });
            return false;
        }
    }

    // Validar gols en contra
    for (let i = 0; i < numGolsContra; i++) {
        const minut = document.querySelector(`[name="gol_contra_minut_${i}"]`)?.value;
if (!minut || minut <= 0 || minut > duradaPartit) {

            await Swal.fire({
                icon: 'warning',
                title: 'Dades incompletes',
text: `⚠️ Gol en contra ${i + 1}: falta el minut o el minut és massa alt.`,
                confirmButtonText: 'OK'
            });
            return false;
        }
    }

    // Validar canvis
   // Validar canvis
        for (let i = 0; i < numCanvis; i++) {
            const minut = document.querySelector(`[name="canvi_minut_${i}"]`)?.value;
            const surt = document.querySelector(`[name="canvi_surt_${i}"]`)?.value;
            const entra = document.querySelector(`[name="canvi_entra_${i}"]`)?.value;

if (!minut || minut <= 0 || minut > duradaPartit || !surt || entra === '') {
                await Swal.fire({
                icon: 'warning',
                title: 'Dades incompletes',
text: `⚠️ Canvi ${i + 1}: falta el jugador, el minut o el minut és massa alt.`,
                confirmButtonText: 'OK'
            });
            return false;
            }
        }


    // Validar expulsions
    for (let i = 0; i < numExpulsions; i++) {
        const minut = document.querySelector(`[name="expulsio_minut_${i}"]`)?.value;
        const jugador = document.querySelector(`[name="expulsio_jugador_${i}"]`)?.value;
if (!minut || minut <= 0 || minut > duradaPartit || !jugador) {
            await Swal.fire({
                icon: 'warning',
                title: 'Dades incompletes',
text: `⚠️ Expulsió ${i + 1}: falta el jugador, el minut o el minut és massa alt.`,
                confirmButtonText: 'OK'
            });
            return false;
        }
    }

    // Assegurar                     ***
    let errors = [];

    jugadorsEquip.forEach(j => {
        const jCheck = document.querySelector(`[name="jugador_${j.id}_j"]`);
        const tCheck = document.querySelector(`[name="jugador_${j.id}_t"]`);
        const minuts = parseInt(document.querySelector(`[name="jugador_${j.id}_minuts"]`)?.value || 0);

        if (minuts > 0 && (!jCheck || !jCheck.checked)) {
            errors.push(`⚠️ El jugador amb dorsal ${j.dorsal ?? ''} ${j.nom} té minuts però no està marcat com a jugat.`);
        }

        if (jCheck?.checked && minuts <= 0 && !tCheck?.checked) {
    errors.push(`⚠️ El jugador amb dorsal ${j.dorsal ?? ''} ${j.nom} està marcat com a jugat però té ${minuts} minuts.`);
}

    });

    if (errors.length > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Revisa els jugadors',
            html: errors.join('<br>'),
            confirmButtonText: 'OK'
        });
        return false;
    }


    return true;
}


async function guardarDades() {
    const jugadorsSeleccionats = [];
    const gols = [];
    const canvisList = [];
    let totalTitulars = 0;
    let totalMinuts = 0;

    // 🔒 1. Demana el token CSRF primer
    await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

    // 🔐 2. Llegeix el token des del cookie
    const csrfToken = document.cookie
        .split('; ')
        .find(row => row.startsWith('XSRF-TOKEN='))
        ?.split('=')[1];

    // ❗ Si no troba el token, avisa
    if (!csrfToken) {
        await Swal.fire({
            icon: 'error',
            title: 'Error de seguretat',
            text: "❌ No s'ha pogut obtenir el token CSRF.",
            confirmButtonText: 'OK'
        });
        return;
    }

    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-XSRF-TOKEN': decodeURIComponent(csrfToken),
    };

    // 🔍 Recol·lectar dades dels jugadors
    jugadorsEquip.forEach(j => {
        const jCheck = document.querySelector(`[name="jugador_${j.id}_j"]`);

        const esTitular = document.querySelector(`[name="jugador_${j.id}_t"]`)?.checked || false;
        const minuts = parseInt(document.querySelector(`[name="jugador_${j.id}_minuts"]`)?.value || 0);

        if (minuts > 0 && jCheck?.checked) {
            totalMinuts += minuts;
            if (esTitular) totalTitulars++;

            jugadorsSeleccionats.push({
                jugador_id: j.id,
                partit_id: partitId,
                partido_jugado: true,
                titular: esTitular,
                gols_jugador: parseInt(document.querySelector(`[name="jugador_${j.id}_gols"]`)?.value || 0),
                expulsio: parseInt(document.querySelector(`[name="jugador_${j.id}_expulsio"]`)?.value || 0),
                minuts_jugats: minuts,
                punts_equip_jjp: parseInt(document.querySelector(`[name="jugador_${j.id}_jjp"]`)?.value || 0),
                punts_equip_jec: parseInt(document.querySelector(`[name="jugador_${j.id}_jec"]`)?.value || 0),
                gols_favor_jec: parseInt(document.querySelector(`[name="jugador_${j.id}_gfjec"]`)?.value || 0),
                gols_contra_jec: parseInt(document.querySelector(`[name="jugador_${j.id}_gcjec"]`)?.value || 0),
                dif_gols_jec: parseInt(document.querySelector(`[name="jugador_${j.id}_dif"]`)?.value || 0),
            });
        }

    });

    // 🔍 Comprovem si el partit ja està marcat com jugat
    let dadesPartit;
    try {
        const res = await fetch(`/api/partits/${partitId}`, {
            credentials: 'include',
            headers: { 'Accept': 'application/json' }
        });
        dadesPartit = await res.json();
    } catch (err) {
        await Swal.fire({
            icon: 'error',
            title: 'Error de connexió',
            text: "❌ Error carregant dades del partit.",
            confirmButtonText: 'OK'
        });
        console.error(err);
        return;
    }

    if (dadesPartit.partit_jugat) {
        const { isConfirmed } = await Swal.fire({
            icon: 'question',
            title: 'Partit ja jugat',
            text: '⚠️ Aquest partit ja està marcat com a jugat. Vols sobreescriure les dades anteriors?',
            showCancelButton: true,
            confirmButtonText: 'Sí, sobreescriu',
            cancelButtonText: 'No, cancel·la'
        });

        if (!isConfirmed) return;

        try {
            const neteja = await fetch(`/api/partits/${partitId}/netejar-dades`, {
                method: 'DELETE',
                credentials: 'include',
                headers
            });
            if (!neteja.ok) throw await neteja.json();
        } catch (e) {
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "❌ Error eliminant les dades anteriors.",
                confirmButtonText: 'OK'
            });
            console.error(e);
            return;
        }
    }

    // 🔁 Gols i Canvis (igual que abans)
    const numCanvis = parseInt(document.getElementById('canvis').value) || 0;
    for (let i = 0; i < numCanvis; i++) {
        const minut = parseInt(document.querySelector(`[name="canvi_minut_${i}"]`)?.value);
        const entraId = document.querySelector(`[name="canvi_entra_${i}"]`)?.value;
        const surtId = document.querySelector(`[name="canvi_surt_${i}"]`)?.value;
        if (!isNaN(minut) && entraId && surtId) {
            canvisList.push({
                partit_id: partitId,
                jugador_entra_id: entraId === 'null' ? null : entraId,
                jugador_surt_id: surtId,
                minut: minut
            });
        }
    }

    const numGolsFavor = parseInt(document.getElementById('golsFavor').value) || 0;
    for (let i = 0; i < numGolsFavor; i++) {
        const minut = parseInt(document.querySelector(`[name="gol_favor_minut_${i}"]`)?.value);
        const jugadorId = document.querySelector(`[name="gol_favor_jugador_${i}"]`)?.value || null;
        if (!isNaN(minut)) {
            gols.push({
                partit_id: partitId,
                jugador_id: jugadorId !== 'null' ? jugadorId : null,
                minut: minut,
                tipo_gol: 'favor'
            });
        }
    }

    const numGolsContra = parseInt(document.getElementById('golsContra').value) || 0;
    for (let i = 0; i < numGolsContra; i++) {
        const minut = parseInt(document.querySelector(`[name="gol_contra_minut_${i}"]`)?.value);
        if (!isNaN(minut)) {
            gols.push({
                partit_id: partitId,
                jugador_id: null,
                minut: minut,
                tipo_gol: 'contra'
            });
        }
    }

    // ✅ ENVIAMENT: estadístiques
    for (const jugador of jugadorsSeleccionats) {
        try {
            await fetch('/api/estadistiques', {
                method: 'POST',
                headers,
                credentials: 'include',
                body: JSON.stringify(jugador)
            });
        } catch (err) {
            console.error(`❌ Error enviant estadística per jugador ${jugador.jugador_id}`, err);
        }
    }

    // ✅ ENVIAMENT: gols
    for (const gol of gols) {
        try {
            await fetch('/api/gols', {
                method: 'POST',
                headers,
                credentials: 'include',
                body: JSON.stringify(gol)
            });
        } catch (err) {
            console.error('❌ Error enviant gol', err);
        }
    }

    // ✅ ENVIAMENT: canvis
    for (const canvi of canvisList) {
        try {
            await fetch('/api/canvis', {
                method: 'POST',
                headers,
                credentials: 'include',
                body: JSON.stringify(canvi)
            });
        } catch (err) {
            console.error('❌ Error enviant canvi', err);
        }
    }

    // ✅ UPDATE: marquem partit com jugat
    try {
        await fetch(`/api/partits/${partitId}`, {
            method: 'PUT',
            headers,
            credentials: 'include',
            body: JSON.stringify({
                gols_favor: parseInt(document.getElementById('golsFavor').value),
                gols_contra: parseInt(document.getElementById('golsContra').value),
                partit_jugat: true
            })
        });
    } catch (err) {
        alert("⚠️ Dades enviades però error actualitzant el partit.");
        console.error(err);
    }

    try {
    await fetch(`/api/partits/${partitId}`, {
        method: 'PUT',
        headers,
        credentials: 'include',
        body: JSON.stringify({
            gols_favor: parseInt(document.getElementById('golsFavor').value),
            gols_contra: parseInt(document.getElementById('golsContra').value),
            partit_jugat: true
        })
    });

    // ✅ Missatge de confirmació amb SweetAlert2
    Swal.fire({
        icon: 'success',
        title: 'Dades desades!',
        text: 'Les estadístiques s\'han guardat correctament.',
        confirmButtonText: 'OK'
    });

} catch (err) {
    alert("⚠️ Dades enviades però error actualitzant el partit.");
    console.error(err);
}


}





});
</script>
@endsection

