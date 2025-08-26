<form method="POST" action="{{ route('club.events.action.submit', $event) }}">
  @csrf
  <input type="hidden" name="action_type" value="{{ $event->action_type }}">

  <div style="display:grid;gap:.75rem;grid-template-columns:1fr 1fr">
    <label>Nom i cognoms
      <input name="nom" type="text" required>
    </label>
    <label>Data naixement
      <input name="data_naixement" type="date" required>
    </label>
    <label>Tutor/a
      <input name="tutor" type="text" required>
    </label>
    <label>Telèfon
      <input name="telefon" type="text" required>
    </label>
    <label>Email
      <input name="email" type="email" required>
    </label>
    <label style="grid-column:1/-1">Intoleràncies / observacions
      <input name="intolerancies" type="text" placeholder="Celíac, lactosa, etc.">
    </label>
  </div>

  <label style="display:flex;gap:.5rem;align-items:center;margin:.75rem 0">
    <input type="checkbox" name="accepto" required>
    Accepto la política de privacitat i l’ús de dades per a la inscripció.
  </label>

  <button class="btn-accio" type="submit">Enviar inscripció</button>
</form>
