@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/noticiesAntigues.css') }}">
@endsection

@section('content')
<div class="Introduccio1">
    @foreach ($noticiesAntigues as $noticia)
        <div class="Apartat">
            <div class="noticia-simple">
                <h3 class="noticia-titol">{{ $noticia->titol }}</h3>
                <p class="noticia-data">
                    {{ \Carbon\Carbon::parse($noticia->data)->format('d/m/y') }} —
                    {{ strtoupper(str_replace('_', ' ', $noticia->seccio)) }}
                </p>
                <p class="noticia-descripcio">{{ $noticia->descripcio }}</p>
            </div>
        </div> <!-- <- tanca el div.Apartat -->
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $noticiesAntigues->links() }}
</div>
@endsection
