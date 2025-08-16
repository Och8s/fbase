@extends('layouts.public')

@section('title', 'Cronologia del Club')@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/historia/crono.css') }}">
@endsection
@section('content')
<div class="cronologia-h">
  <h2 class="cronologia-title">Èxits i Fites del Club</h2>

  <div class="timeline-h">
    <div class="timeline-h__track"></div>

    @foreach($exits->sortBy('data')->values() as $i => $event)
      @php
        $pos = ($i % 2 === 0) ? 'up' : 'down';   // 1º arriba, 2º abajo, etc.
        $year = $event->data ? $event->data->format('Y') : '—';
      @endphp

      <div class="timeline-h__item {{ $pos }}">
        <div class="timeline-h__bubble">
          <div class="timeline-h__year">{{ $year }}</div>
          <div class="timeline-h__title" title="{{ $event->titol }}">{{ $event->titol ?: '—' }}</div>
        </div>
        <div class="timeline-h__dot"></div>
        <div class="timeline-h__stem"></div>
      </div>
    @endforeach
  </div>
</div>
@endsection

