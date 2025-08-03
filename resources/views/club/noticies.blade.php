@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/noticies.css') }}">
@endsection

@section('content')
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

<div class="text-center mt-4">
<a href="{{ route('club.noticies.antigues') }}" class="btn btn-outline-primary">Veure notícies antigues</a>
</div>

@endsection
