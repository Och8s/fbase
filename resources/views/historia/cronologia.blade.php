@extends('layouts.public')

@section('title', 'Cronologia del Club')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/historia/crono.css') }}">
@endsection

@section('content')
<div class="cronologia-h">
  <h2 class="cronologia-title">Èxits i Fites del Club</h2>

  <div class="timeline-h">
    <div class="timeline-h__track"></div>

    @foreach($exits->sortBy('data')->values() as $i => $event)
      @php
        $pos  = ($i % 2 === 0) ? 'up' : 'down';
        $year = $event->data ? $event->data->format('Y') : '—';
        $fotoUrl = $event->foto ? asset($event->foto) : '';
      @endphp

      <div class="timeline-h__item {{ $pos }}">
       <div
  class="timeline-h__bubble js-exit"
  role="button"
  tabindex="0"
  data-titol-larg="{{ e($event->titolLlarg ?? $event->titol) }}"
  data-descripcio="{{ ($event->descripcio) }}"
  data-foto="{{ $fotoUrl }}"
>
  <span class="timeline-h__year">{{ $year }}</span>
  <div class="timeline-h__title" title="{{ $event->titolLarg ?? $event->titol }}">
  {{ $event->titol ?: '—' }} <span class="more-info">...</span>
</div>

</div>


        <div class="timeline-h__dot"></div>
        <div class="timeline-h__stem"></div>
      </div>
    @endforeach
  </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/sweetAlertExits.js') }}"></script>
@endsection
