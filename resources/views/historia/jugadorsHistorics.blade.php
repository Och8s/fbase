@extends('layouts.public')

@section('title', 'Jugadors Històrics')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/historia/jugHistorics.css') }}">
@endsection

@section('content')
<div class="jugadors-h">

  <div class="jugadors-header">
    <h2 class="jugadors-title">Jugadors i Figures inolvidables</h2>
    <button class="refresh-btn"
            onclick="window.location.href='{{ route('historia.jugadors') }}?r={{ \Illuminate\Support\Str::random(6) }}'">
        ♻️ Refresh
    </button>
  </div>

  @php
    $top = $jugadors->slice(0, 5);
    $mid = $jugadors->slice(5, 4);
    $bot = $jugadors->slice(9, 5);
  @endphp

  <div class="fila-jugadors cols-5">
    @foreach($top as $jugador)
      <div class="jugador-card js-exit"
           role="button" tabindex="0"
           data-nom="{{ e($jugador->nom) }}"
           data-cognoms="{{ e($jugador->cognoms) }}"
           data-apodo="{{ e($jugador->apodo ?? '') }}"
           data-foto="{{ asset('images/historia/jugadors_historics/' . $jugador->foto) }}"
           data-posicio="{{ e($jugador->posicio ?? '') }}"
           data-etapa-curta="{{ e($jugador->etapa_curta ?? '') }}"
           data-descripcio-curta="{{ e($jugador->descripcio_curta ?? '') }}"
           data-descripcio-llarga="{{ e($jugador->descripcio_llarga ?? '') }}"
      >
        <p class="jugador-nom">{{ $jugador->nom }} {{ $jugador->cognoms }}</p>
        <img src="{{ asset('images/historia/jugadors_historics/' . $jugador->foto) }}"
             alt="{{ $jugador->nom }}" class="jugador-foto">
      </div>
    @endforeach
  </div>

  <div class="fila-jugadors cols-4">
    @foreach($mid as $jugador)
      <div class="jugador-card js-exit"
           role="button" tabindex="0"
           data-nom="{{ e($jugador->nom) }}"
           data-cognoms="{{ e($jugador->cognoms) }}"
           data-apodo="{{ e($jugador->apodo ?? '') }}"
           data-foto="{{ asset('images/historia/jugadors_historics/' . $jugador->foto) }}"
           data-posicio="{{ e($jugador->posicio ?? '') }}"
           data-etapa-curta="{{ e($jugador->etapa_curta ?? '') }}"
           data-descripcio-curta="{{ e($jugador->descripcio_curta ?? '') }}"
           data-descripcio-llarga="{{ e($jugador->descripcio_llarga ?? '') }}"
      >
        <p class="jugador-nom">{{ $jugador->nom }} {{ $jugador->cognoms }}</p>
        <img src="{{ asset('images/historia/jugadors_historics/' . $jugador->foto) }}"
             alt="{{ $jugador->nom }}" class="jugador-foto">
      </div>
    @endforeach
  </div>

  <div class="fila-jugadors cols-5">
    @foreach($bot as $jugador)
      <div class="jugador-card js-exit"
           role="button" tabindex="0"
           data-nom="{{ e($jugador->nom) }}"
           data-cognoms="{{ e($jugador->cognoms) }}"
           data-apodo="{{ e($jugador->apodo ?? '') }}"
           data-foto="{{ asset('images/historia/jugadors_historics/' . $jugador->foto) }}"
           data-posicio="{{ e($jugador->posicio ?? '') }}"
           data-etapa-curta="{{ e($jugador->etapa_curta ?? '') }}"
           data-descripcio-curta="{{ e($jugador->descripcio_curta ?? '') }}"
           data-descripcio-llarga="{{ e($jugador->descripcio_llarga ?? '') }}"
      >
        <p class="jugador-nom">{{ $jugador->nom }} {{ $jugador->cognoms }}</p>
        <img src="{{ asset('images/historia/jugadors_historics/' . $jugador->foto) }}"
             alt="{{ $jugador->nom }}" class="jugador-foto">
      </div>
    @endforeach
  </div>

</div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/sweetAlertJugadors.js') }}"></script>
@endsection
