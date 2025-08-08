@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/porters/horari.css') }}">
@endsection

@section('content')

{{-- Fila superior: Horari (60%) + Calendari (30%) --}}
<div class="top-row">
    {{-- Horari (60%) --}}
    <div class="col-left card-box">
        <h2 class="titol-noticies">HORARI D'ENTRENAMENTS</h2>

        <div class="horari-grid">
            <div class="dia">
                <h4 class="subtitol-dia">DILLUNS</h4>
                <p>1ª Sessió de 17:30 h a 19:00 h</p>
                <p>2ª Sessió de 19:00 h a 20:30 h</p>
            </div>
            <div class="dia">
                <h4 class="subtitol-dia">DIVENDRES</h4>
                 <p>1ª Sessió de 17:30 h a 19:00 h</p>
                <p>2ª Sessió de 19:00 h a 20:30 h</p>
            </div>
        </div>
    </div>
<div class="separator"></div>

    {{-- Calendari (30%) --}}
    <div class="col-right card-box">
        <h2 class="titol-noticies">CALENDARI</h2>
        <img src="{{ asset('images/porters/calendari.jpg') }}" alt="Calendari" class="img-calendari">
    </div>
</div>


{{-- Esdeveniments --}}
<h2 class="titol-noticies" style="margin-top: 1rem;">ESDEVENIMENTS</h2>

@if($events->count() > 0)
    <div class="Introduccio1">
        @foreach ($events as $event)
            <div class="Apartat">
                <div class="bloc-noticia">
                    {{-- Si más adelante añades foto al evento, ponla aquí con .noticia-img --}}
                    <div class="noticia-dades" style="width:100%;">
                        <div class="dades-superior" style="justify-content:flex-start;">
                            <div class="noticia-titol">
                                <h3>{{ $event->titol }}</h3>
                            </div>
                        </div>
                                        <p style="text-align:left; width:100%; margin-top: .5rem;">{{ $event->descripcio }}</p>

                        <div class="dades-inferior" style="margin-top: 10px;">
                            <p class="noticia-data">
                                📅 {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y') }}
                                @if($event->hora_inici) ⏰ {{ \Carbon\Carbon::parse($event->hora_inici)->format('H:i') }} @endif
                                @if($event->hora_fi) - {{ \Carbon\Carbon::parse($event->hora_fi)->format('H:i') }} @endif
                                @if($event->lloc) 📍 {{ $event->lloc }} @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center">No hi ha esdeveniments programats en aquest moment.</p>
@endif
@endsection
