@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="container mt-4">
        <h4 id="titolPartit" class="mb-3"></h4>
    </div>

    <!-- INFORMACIÓ DEL PARTIT -->
    <div id="infoPartit">
        <h4>Dades generals del partit</h4>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Gols a favor</label>
                <input type="number" id="golsFavor" class="form-control" min="0" max="25">
                                <div id="inputsGolsFavor" class="mt-2"></div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Gols en contra</label>
                <input type="number" id="golsContra" class="form-control" min="0" max="25">
                <div id="inputsGolsContra" class="mt-2"></div>
            </div>

            <div class="col-md-4">
                <label class="form-label">Canvis</label>
                <input type="number" id="canvis" class="form-control" min="0" max="20">
                <div id="inputsCanvis" class="mt-2"></div>
            </div>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jugador</th>
                        <th>J</th>
                        <th>T</th>
                        <th>GOL</th>
                        <th>E</th>
                        <th>MIN JUG</th>
                        <th>PEQ JJP</th>
                        <th>PEQ JEC</th>
                        <th>GOL FJC</th>
                        <th>GOL CJC</th>
                        <th>DIF GOL</th>
                    </tr>
                </thead>

                <tbody id="cosTaulaJugadors"></tbody>
            </table>
        </div>
    </div>
    <div class="text-end mt-3">
        <button id="guardarEstadistiques" class="btn btn-success">💾 Guardar dades</button>
    </div>

</div>
@endsection
{{-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX script XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX --}}

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const partitId = window.location.pathname.split('/').pop();
    let jugadorsEquip = [];
    let minutsJugats = {};

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

            jugadorsEquip.forEach(j => {
    minutsJugats[j.id] = 0;

    const fila = document.createElement('tr');
    fila.innerHTML = `
        <td>${j.nom}</td>
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
        jCheckbox.addEventListener('change', actualitzaPEQJJP);
    }

});


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
                    minutsJugats[id] += 95; // S’afegeixen 95 minuts al total del jugador
                } else {            // Si es desmarca com a titular...
                    minutsJugats[id] -= 95; // ...se li resten els 95 minuts
                }
                // S’actualitza el camp visual de minuts jugats
                if (minutsInput) minutsInput.value = minutsJugats[id];
                // Recalcula els punts PEQ JJP (punts de l’equip si el jugador ha jugat)
                actualitzaPEQJJP();
                // Torna a calcular les estadístiques en base als minuts jugats (gols en camp, diferència, etc.)
                actualitzaGolsJugadorEnCamp();
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
        <input type="number" name="gol_favor_minut_${i}" class="form-control mb-1" min="1" max="95" />
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
                <input type="number" name="gol_contra_minut_${i}" class="form-control" min="1" max="95" />
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
        minutsJugats[id] = document.querySelector(`[name="jugador_${id}_t"]`).checked ? 95 : 0;
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
        inputMinut.max = 95;
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
                const suma = -(95 - minut); // restem minuts jugats
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
                const suma = 95 - minut;
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
        });

        selectSurt.addEventListener('change', () => {
            gestionaSurt();
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
        });

        selectEntra.addEventListener('change', () => {
            gestionaEntra();
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
        });
    }

    actualitzaGolsJugadorEnCamp();
});


expulsions.addEventListener('change', function () {
    const count = parseInt(this.value) || 0;
    inputsExpulsions.innerHTML = '';

    // 🧹 Reseteja minuts i expulsions
    jugadorsEquip.forEach(j => {
        const id = j.id;
        const tCheck = document.querySelector(`[name="jugador_${id}_t"]`);
        const minutsBase = tCheck && tCheck.checked ? 95 : 0;
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
        inputMinut.max = 95;
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
        });

        selectJugador.addEventListener('change', () => {
            actualitzaGolsJugadorEnCamp();
            actualitzaPEQJJP();
        });
    }

    // Força actualització després de generar les expulsions
    actualitzaGolsJugadorEnCamp();
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
            intervals.push([1, 95]);
            minutsJugats[id] = 95;
        }

        // Canvis
        for (let i = 0; i < numCanvis; i++) {
            const minut = parseInt(document.querySelector(`[name="canvi_minut_${i}"]`)?.value);
            const entra = document.querySelector(`[name="canvi_entra_${i}"]`)?.value;
            const surt = document.querySelector(`[name="canvi_surt_${i}"]`)?.value;

            if (!isNaN(minut)) {
                if (surt == id) {
                    const last = intervals.find(int => int[1] === 95);
                    if (last) last[1] = minut;
                    minutsJugats[id] -= (95 - minut);
                }

                if (entra == id) {
                    const inici = minut + 1;
                    if (inici <= 95) {
                        intervals.push([inici, 95]);
                        minutsJugats[id] += (95 - inici + 1);
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
            const last = intervals?.find(int => int[1] === 95);
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

document.getElementById('guardarEstadistiques').addEventListener('click', async function () {
    for (const jugador of jugadorsEquip) {
        const id = jugador.id;
        const data = {
            jugador_id: id,
            partit_id: partitId,
            partido_jugado: document.querySelector(`[name="jugador_${id}_j"]`)?.checked || false,
            titular: document.querySelector(`[name="jugador_${id}_t"]`)?.checked || false,
            gols_jugador: parseInt(document.querySelector(`[name="jugador_${id}_gols"]`)?.value || 0),
            expulsio: parseInt(document.querySelector(`[name="jugador_${id}_expulsio"]`)?.value || 0),
            minuts_jugats: parseInt(document.querySelector(`[name="jugador_${id}_minuts"]`)?.value || 0),
            punts_equip_jjp: parseInt(document.querySelector(`[name="jugador_${id}_jjp"]`)?.value || 0),
            punts_equip_jec: parseInt(document.querySelector(`[name="jugador_${id}_jec"]`)?.value || 0),
            gols_favor_jec: parseInt(document.querySelector(`[name="jugador_${id}_gfjec"]`)?.value || 0),
            gols_contra_jec: parseInt(document.querySelector(`[name="jugador_${id}_gcjec"]`)?.value || 0),
            dif_gols_jec: parseInt(document.querySelector(`[name="jugador_${id}_dif"]`)?.value || 0),
        };

        try {
            const response = await fetch('/api/estadistiques', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                credentials: 'include',
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const error = await response.json();
                console.error(`Error amb jugador ${id}:`, error);
            } else {
                const result = await response.json();
                console.log(`Estadística creada:`, result.estadistica);
            }
        } catch (err) {
            console.error(`Error de xarxa amb jugador ${id}:`, err);
        }
    }

    alert("📊 Dades guardades!");
});




});
</script>
@endsection

