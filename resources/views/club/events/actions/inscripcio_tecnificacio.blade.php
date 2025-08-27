<form method="POST" action="{{ route('club.events.action.submit', $event) }}">
  @csrf

  {{-- Traçat bàsic --}}
  <input type="hidden" name="event_id" value="{{ $event->id }}">
  <input type="hidden" name="tipus" value="tecnificacio">

  <div class="grid" style="display:grid;gap:.75rem;grid-template-columns:1fr 1fr">

    {{-- 0) Pregunta: és jugador del club? --}}
    <div style="grid-column:1/-1; margin:.5rem 0">
      <p class="mb-1"><strong>El nen/a és jugador/a del club?</strong></p>
      <label style="margin-right:1rem">
        <input type="radio" name="es_jugador_club" value="1" {{ old('es_jugador_club')=='1'?'checked':'' }}>
        Sí, ja és jugador/a del club
      </label>
      <label>
        <input type="radio" name="es_jugador_club" value="0" {{ old('es_jugador_club','0')=='0'?'checked':'' }}>
        No, no és jugador/a del club
      </label>
      @error('es_jugador_club') <small class="text-danger d-block">{{ $message }}</small> @enderror
    </div>

    {{-- 1) SI ÉS del club: només DNI + dades logístiques/consents (no exposem dades personals) --}}
    <div id="sec-club" style="{{ old('es_jugador_club')=='1' ? '' : 'display:none' }};grid-column:1/-1">

      <div style="display:grid;gap:.75rem;grid-template-columns:1fr 1fr">
        <label for="dni_club">DNI del jugador
          <input id="dni_club" name="dni" type="text" value="{{ old('dni') }}" required
                 pattern="[0-9XYZxyz][0-9]{7}[A-Za-z]" title="Format DNI/NIE vàlid (8 dígits + lletra)">
          @error('dni') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        {{-- Contacte opcional per a aquest event --}}
        <label for="telefon_club">Telèfon (opcional)
          <input id="telefon_club" name="telefon" type="tel" value="{{ old('telefon') }}" placeholder="(opcional)">
          @error('telefon') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="email_club">Email (opcional)
          <input id="email_club" name="email" type="email" value="{{ old('email') }}" placeholder="(opcional)">
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        {{-- IBAN alternatiu per a aquest event (sense exposar el registrat) --}}
        <div style="grid-column:1/-1">
          <input type="hidden" name="usar_compte_registrat" value="1">
          <label for="chk_altre_iban" style="display:flex;gap:.5rem;align-items:center;margin:.25rem 0">
            <input id="chk_altre_iban" type="checkbox" name="usar_compte_registrat" value="0" {{ old('usar_compte_registrat')==='0'?'checked':'' }}>
            Indicar un altre compte per al cobrament d’aquest event
          </label>
          <div id="wrap_nou_iban"
     style="{{ old('usar_compte_registrat')==='0' ? '' : 'display:none' }}"
     aria-hidden="{{ old('usar_compte_registrat')==='0' ? 'false' : 'true' }}">
  <input id="num_compte_club" name="num_compte" type="text" value="{{ old('num_compte') }}"
         placeholder="ES00 0000 0000 00 0000000000"
         pattern="[A-Za-z]{2}[0-9]{2}[A-Za-z0-9 ]{11,30}"
         {{ old('usar_compte_registrat')==='0' ? '' : 'disabled' }}>
  @error('num_compte') <small class="text-danger d-block">{{ $message }}</small> @enderror
</div>

        </div>

        {{-- Camps mèdics/logístics --}}


        <label for="incapacitat_club" style="grid-column:1/-1">Incapacitat  / observacions mèdiques
          <input id="incapacitat_club" name="incapacitat" type="text" value="{{ old('incapacitat') }}">
          @error('incapacitat') <small class="text-danger">{{ $message }}</small> @enderror
        </label>



        {{-- Observacions logístiques --}}
        <label for="observacions_club" style="grid-column:1/-1">Observacions per a l’organització
          <textarea id="observacions_club" name="observacions" rows="3"
                    placeholder="Ex: Vindrem a recollir-lo a les 17:15; té medicació a les 12:30; ...">{{ old('observacions') }}</textarea>
        </label>
        @error('observacions') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Consents --}}
        <div style="grid-column:1/-1; margin-top:.25rem; padding:1rem; border:1px solid #ddd; border-radius:10px; background:#fafafa">
          <input type="hidden" name="consentiment_pares" value="0">
          <label for="consentiment_pares_club" style="display:flex; gap:.75rem; align-items:flex-start;">
            <input id="consentiment_pares_club" type="checkbox" name="consentiment_pares" value="1" required style="margin-top:.3rem">
            <span style="font-size:.9rem; line-height:1.5">
              Com a pare/mare/tutor legal, <strong>autoritzem la participació</strong> del menor inscrit en aquest Campus,
              i <strong>acceptem la política de privacitat</strong> i el tractament de les seves dades per a la gestió de la inscripció.
              Ens fem responsables de la veracitat de les dades aportades i consentim que el Club es posi en contacte per qüestions organitzatives.
            </span>
          </label>
          @error('consentiment_pares') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div style="grid-column:1/-1">
          <input type="hidden" name="drets_imatge" value="0">
          <label for="drets_imatge_club" style="display:flex;gap:.5rem;align-items:flex-start;margin:.25rem 0">
            <input id="drets_imatge_club" type="checkbox" name="drets_imatge" value="1" {{ old('drets_imatge')?'checked':'' }}>
            <span>Autoritzo l’ús de la imatge del menor per a finalitats informatives i de difusió del Club.</span>
          </label>
          @error('drets_imatge') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
      </div>
    </div>

    {{-- 2) NO ÉS del club: formulari complet (dades personals + la resta) --}}
    <div id="sec-no-club" style="{{ old('es_jugador_club','0')=='0' ? '' : 'display:none' }};grid-column:1/-1">
      <div style="display:grid;gap:.75rem;grid-template-columns:1fr 1fr">

        {{-- Alumne nou --}}
        <label for="nom">Nom
          <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required autocomplete="given-name">
          @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="cognoms">Cognoms
          <input id="cognoms" name="cognoms" type="text" value="{{ old('cognoms') }}" required autocomplete="family-name">
          @error('cognoms') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="dni">DNI
          <input id="dni" name="dni" type="text" value="{{ old('dni') }}" required
                 pattern="[0-9XYZxyz][0-9]{7}[A-Za-z]" title="Format DNI/NIE vàlid (8 dígits + lletra)">
          @error('dni') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="data_naixement">Data naixement
          <input id="data_naixement" name="data_naixement" type="date" value="{{ old('data_naixement') }}" required>
          @error('data_naixement') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        {{-- Contacte i dades addicionals --}}
        <label for="telefon">Telèfon
          <input id="telefon" name="telefon" type="tel" value="{{ old('telefon') }}" autocomplete="tel">
          @error('telefon') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="email">Email
          <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email">
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="seg_social">Seguretat Social
          <input id="seg_social" name="seg_social" type="text" value="{{ old('seg_social') }}">
          @error('seg_social') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="domicili">Domicili
          <input id="domicili" name="domicili" type="text" value="{{ old('domicili') }}" autocomplete="address-line1">
          @error('domicili') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="cp">Codi Postal
          <input id="cp" name="cp" type="text" value="{{ old('cp') }}" autocomplete="postal-code">
          @error('cp') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="nom_pares">Nom pare/mare/tutor
          <input id="nom_pares" name="nom_pares" type="text" value="{{ old('nom_pares') }}">
          @error('nom_pares') <small class="text-danger">{{ $message }}</small> @enderror
        </label>

        <label for="num_compte" style="grid-column:1/-1">Número de compte (IBAN)
          <input id="num_compte" name="num_compte" type="text" value="{{ old('num_compte') }}" placeholder="ES00 0000 0000 00 0000000000"
                 pattern="[A-Za-z]{2}[0-9]{2}[A-Za-z0-9 ]{11,30}">
          @error('num_compte') <small class="text-danger">{{ $message }}</small> @enderror
        </label>


        <label for="incapacitat" style="grid-column:1/-1">Incapacitat / observacions mèdiques
          <input id="incapacitat" name="incapacitat" type="text" value="{{ old('incapacitat') }}">
          @error('incapacitat') <small class="text-danger">{{ $message }}</small> @enderror
        </label>



        <label for="observacions" style="grid-column:1/-1">Observacions per a l’organització
          <textarea id="observacions" name="observacions" rows="3"
                    placeholder="Ex: Vindrem a recollir-lo a les 17:15; té medicació a les 12:30; ...">{{ old('observacions') }}</textarea>
        </label>
        @error('observacions') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Consents --}}
        <div style="grid-column:1/-1; margin-top:.25rem; padding:1rem; border:1px solid #ddd; border-radius:10px; background:#fafafa">
          <input type="hidden" name="consentiment_pares" value="0">
          <label for="consentiment_pares" style="display:flex; gap:.75rem; align-items:flex-start;">
            <input id="consentiment_pares" type="checkbox" name="consentiment_pares" value="1" required style="margin-top:.3rem">
            <span style="font-size:.9rem; line-height:1.5">
              Com a pare/mare/tutor legal, <strong>autoritzem la participació</strong> del menor inscrit en aquest Campus,
              i <strong>acceptem la política de privacitat</strong> i el tractament de les seves dades per a la gestió de la inscripció.
              Ens fem responsables de la veracitat de les dades aportades i consentim que el Club es posi en contacte per qüestions organitzatives.
            </span>
          </label>
          @error('consentiment_pares') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div style="grid-column:1/-1">
          <input type="hidden" name="drets_imatge" value="0">
          <label for="drets_imatge" style="display:flex;gap:.5rem;align-items:flex-start;margin:.25rem 0">
            <input id="drets_imatge" type="checkbox" name="drets_imatge" value="1" {{ old('drets_imatge')?'checked':'' }}>
            <span>Autoritzo l’ús de la imatge del menor per a finalitats informatives i de difusió del Club.</span>
          </label>
          @error('drets_imatge') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
      </div>
    </div>

  </div>

  <button class="btn-accio" type="submit">Enviar inscripció</button>
</form>

{{-- JS per alternar blocs i per l’IBAN alternatiu en cas de club --}}
<script>
  (function(){
    const radios   = document.querySelectorAll('input[name="es_jugador_club"]');
    const secClub  = document.getElementById('sec-club');
    const secNo    = document.getElementById('sec-no-club');

    const chkIban  = document.getElementById('chk_altre_iban');
    const wrapIban = document.getElementById('wrap_nou_iban');
    const inpIban  = document.getElementById('num_compte_club');

    function setIbanVisibility(visible){
      if (!wrapIban || !inpIban) return;
      wrapIban.style.display = visible ? '' : 'none';
      wrapIban.setAttribute('aria-hidden', visible ? 'false' : 'true');
      inpIban.disabled = !visible;       // evita enviar si está oculto
      if (!visible) inpIban.value = '';  // limpia valor al ocultar
    }

    function toggleSections(){
      const isClub = document.querySelector('input[name="es_jugador_club"]:checked')?.value === '1';
      if (secClub && secNo) {
        secClub.style.display = isClub ? '' : 'none';
        secNo.style.display   = isClub ? 'none' : '';
      }
      // Si pasa a "No és del club", ocultamos y desmarcamos IBAN alternativo
      if (!isClub && chkIban) {
        chkIban.checked = false;
        setIbanVisibility(false);
      }
    }

    // Eventos
    radios.forEach(r => r.addEventListener('change', toggleSections));
    if (chkIban) {
      chkIban.addEventListener('change', () => setIbanVisibility(chkIban.checked));
    }

    // Estado inicial
    toggleSections();
    if (chkIban) setIbanVisibility(chkIban.checked);
  })();
</script>
