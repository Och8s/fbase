@extends('layouts.public')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/club/formulariSoci.css') }}">
@endsection

@section('content')
<h2 class="titol-formuSoci">FORMULARI PER A NOUS SOCIS</h2>

<div class="formulari-soci">
{{-- AHORA (correcto) --}}
<form action="{{ route('club.presocis.store') }}" method="POST">
            @csrf

        <div class="form-group">
            <label for="name">Nom i Cognoms</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Correu electrònic</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="data_naix">Data de naixement</label>
            <input type="date" name="data_naix" id="data_naix" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefon">Telèfon</label>
            <input type="text" name="telefon" id="telefon" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adreca">Adreça</label>
            <input type="text" name="adreca" id="adreca" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="poblacio">Població</label>
            <input type="text" name="poblacio" id="poblacio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="numero_compte">Número de compte</label>
            <input type="text" name="numero_compte" id="numero_compte" class="form-control" required>
        </div>

        {{-- estat i user_id millor controlar-ho des del backend, no del formulari públic --}}

        <div class="form-submit">
            <button type="submit" class="btn-enviar">Enviar sol·licitud</button>
        </div>
    </form>
</div>
@endsection
