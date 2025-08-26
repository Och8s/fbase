<form method="POST" action="{{ route('club.events.action.submit', $event) }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="action_type" value="{{ $event->action_type }}">
  <label>Fitxer (PDF/JPG/PNG, màx. 5 MB)
    <input type="file" name="fitxer" required>
  </label>
  <button class="btn-accio" type="submit">Pujar</button>
</form>
