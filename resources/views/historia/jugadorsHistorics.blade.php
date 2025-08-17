@extends('layouts.public')

@section('title', 'Jugadors Històrics')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/historia/jugHistorics.css') }}">
@endsection

@section('content')
<div class="cronologia-h">
  <h2 class="cronologia-title">Jugadors històrics del nostre club</h2>

  <div class="jugadors-grid">
    @foreach($jugadors as $jugador)
      <div class="jugador-card">
        <p class="jugador-nom">{{ $jugador->nom }} {{ $jugador->cognoms }}</p>
        <img src="{{ asset('images/jugadorsHistorics/' . $jugador->foto) }}" alt="{{ $jugador->nom }}" class="jugador-foto">
      </div>
    @endforeach
  </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/sweetAlertJugadors.js') }}"></script>
@endsection
