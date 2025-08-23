@extends('layouts.public')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/club/index.css') }}">

<link rel="stylesheet" href="{{ asset('css/club/noticies.css') }}">
@endsection

@section('content')
<h2 class="titol-noticies">NOTÍCIES ACTUALS</h2>


<div class="Introduccio1">
    @foreach ($noticies as $noticia)
        <div class="Apartat">
            <div class="bloc-noticia">
    <div class="noticia-img">
        <img src="{{ asset($noticia->foto) }}" alt="Foto notícia">
    </div>
    <div class="noticia-dades">
        <div class="dades-superior">
            <a href="{{ route('club.noticies.show', $noticia->id) }}">
                <button class="btn-veure">VEURE<br>NOTÍCIA</button>
            </a>
        </div>
        <div class="dades-inferior">
            <p class="noticia-data">{{ \Carbon\Carbon::parse($noticia->data)->format('d/m/y') }}</p>
            <p class="noticia-seccio">{{ strtoupper(str_replace('_', ' ', $noticia->seccio)) }}</p>
        </div>
    </div>
</div>

            <div class="noticia-titol">
                <h3>{{ $noticia->titol }}</h3>
            </div>
        </div>
    @endforeach
</div>

<div class="acces-noticiesAntigues">
    <a href="{{ route('club.noticies.antigues') }}">
        <button class="btn-veure btn-antigues">VEURE HISTÒRIC DE NOTÍCIES</button>
    </a>
</div>

@endsection
