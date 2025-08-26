@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/events.css') }}">
@endsection

@section('content')
<h2 class="titol-events">ACTIVITATS I ESDEVENIMENTS</h2>

<div class="Introduccio1">
    @foreach ($events as $event)
        <div class="Apartat">
            <div class="event-titol">
                <h3>{{ $event->titol }}</h3>
            </div>
            <div class="bloc-event">
                <div class="event-img">
                    <img src="{{ asset($event->foto) }}" alt="Imatge esdeveniment">
                </div>
                <div class="event-dades">
                    <div class="dades-superior">
                        <a href="{{ route('club.events.show', $event->id) }}">
                            <button class="btn-veure">VEURE INFO</button>
                        </a>
                    </div>
                    <div class="dades-inferior">
                        <p class="event-data">{{ \Carbon\Carbon::parse($event->data_inici)->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
