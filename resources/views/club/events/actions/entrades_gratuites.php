<form method="POST" action="{{ route('club.events.action.submit', $event) }}">
  @csrf
  <input type="hidden" name="action_type" value="{{ $event->action_type }}">
  <div style="display:grid;gap:.75rem;grid-template-columns:1fr 1fr">
    <label>Nom i cognoms
      <input name="nom" type="text" required>
    </label>
    <label>Email
      <input name="email" type="email" required>
    </label>
    <label>Quantitat
      <input name="quantitat" type="number" min="1" max="10" required>
    </label>
  </div>
  <button class="btn-accio" type="submit">Reservar</button>
</form>
