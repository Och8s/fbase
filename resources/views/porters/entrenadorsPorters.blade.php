@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/porters/entrenadorsP.css') }}">
@endsection

@section('content')
<div class="container">
    <h2 class="titol-entrenadors">Entrenadors de l'Escola de Porters</h2>
    <div class="entrenadors-container">
        @foreach($entrenadors as $entrenador)
            <div class="entrenador-card">
                <!-- Accede al campo 'foto' de cada entrenador -->
                <img src="{{ asset('images/porters/entrenadorsP/' . $entrenador->foto) }}" alt="Foto entrenador">

                <h4>{{ $entrenador->nom }} {{ $entrenador->cognoms }}</h4>
            </div>
        @endforeach
    </div>
</div>
@endsection
