@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/noticies.css') }}">
@endsection

@section('content')
<div class="Introduccio1">
    @foreach($noticies->take(3) as $noticia)
    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('noticies.show', $noticia->id) }}"><button>{{ strtoupper($noticia->titol) }}</button></a>
            <img src="{{ asset($noticia->foto) }}" alt="{{ $noticia->titol }}">
        </div>
        <div class="MedioA">
            <p>{{ \Illuminate\Support\Str::limit($noticia->descripcio, 100) }}</p>
        </div>
    </div>
    @endforeach
</div>

<div class="Introduccio2">
    @foreach($noticies->slice(3, 3) as $noticia)
    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('noticies.show', $noticia->id) }}"><button>{{ strtoupper($noticia->titol) }}</button></a>
            <img src="{{ asset($noticia->foto) }}" alt="{{ $noticia->titol }}">
        </div>
        <div class="MedioA">
            <p>{{ \Illuminate\Support\Str::limit($noticia->descripcio, 100) }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
