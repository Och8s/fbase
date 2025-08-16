@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/descripcioPlantilla.css') }}">
@endsection

@section('content')
<div class="Introduccio1">
    <div class="ApartatX6">
        <h3 class="titol">{{ $descripcio->titol }}</h3>
        <p class="text">{!! nl2br(e($descripcio->text)) !!}</p>
    </div>
</div>
@endsection
