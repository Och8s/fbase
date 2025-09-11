{{-- resources/views/club/esdevenimentPlantilla.blade.php --}}
@extends('layouts.public')

@section('title', $event->titol . ' | Club')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/club/esdeveniment.css') }}">
@endsection

@section('content')
<main class="esdeveniment-senzill">
  {{-- 1) Títol principal --}}
  <h1 class="ev-title">{{ $event->titol }}</h1>

  {{-- 2) Layout amb 2 columnes: esquerra (foto+dades) i dreta (article) --}}
  <div class="ev-layout">
    {{-- Columna esquerra --}}
    <aside class="ev-left">
      @if($event->foto)
        <div class="ev-image">
          <img src="{{ asset($event->foto) }}" alt="{{ $event->titol }}">
        </div>
      @endif

      @php
        \Carbon\Carbon::setLocale('ca');
        $ini  = \Carbon\Carbon::parse($event->data_inici);
        $fin  = \Carbon\Carbon::parse($event->data_final);
        $mateixDia = $ini->isSameDay($fin);

        $dinarTxt = $event->dinar ? 'Amb dinar' : 'Sense dinar';
        $preuTxt  = is_null($event->preu) ? '—' : number_format($event->preu, 2, ',', '.') . ' €';
      @endphp

      <section class="ev-dades">
        <h2 class="ev-dades-title">Dades de l’esdeveniment</h2>

        {{-- 🌟 Fechas amb format correcte --}}
        @if($mateixDia)
          <p><strong>📅 Dia:</strong> {{ $ini->translatedFormat('d F Y') }}</p>
        @else
          <p>
            <strong>📅 Dies:</strong><br>
            des de {{ $ini->translatedFormat('d F Y') }}<br>
            fins al {{ $fin->translatedFormat('d F Y') }}
          </p>
        @endif

        <p><strong>🕘 Horari:</strong> {{ $event->horari ?: '—' }}</p>
        <p><strong>🍽️ Dinar:</strong> {{ $dinarTxt }}</p>
        <p><strong>💶 Preu:</strong> {{ $preuTxt }}</p>
      </section>
    </aside>

    {{-- Columna dreta --}}
    <article class="ev-right">
      <h2 class="ev-detallat-title">Informació detallada</h2>
      {!! $event->descripcio !!}
      {{-- Botó acció específic --}}
<div class="ev-action-button">
  @switch($event->action_type)
    @case('inscripcio_campus')
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Inscriu-te al Campus</a>
      @break
    @case('inscripcio_tecnificacio')
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Inscriu-te a la Tecnificació</a>
      @break
    @case('ticket_menjar_presentacio')
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Comprar Tiquet Menjar</a>
      @break
    @case('ticket_menjar_soci')
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Comprar Tiquet Soci</a>
      @break
    @case('documentacio')
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Enviar Documentació</a>
      @break
    @case('entrades_gratuites')
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Reservar Entrada</a>
      @break
    @default
      <a href="{{ route('club.events.action', $event) }}" class="btn-accio">Més informació</a>
  @endswitch
</div>


    </article>
  </div>

  {{-- 3) Botó tornar --}}
  <div class="ev-actions">
    <a class="btn-veure btn-back" href="{{ route('club.events') }}">
      <i class="fas fa-arrow-left"></i>
      <span>TORNAR A<br>ESDEVENIMENTS</span>
    </a>
  </div>
</main>
@endsection
