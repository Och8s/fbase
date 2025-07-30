@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/twelveBlocsPatrocinadors.css') }}">
@endsection

@section('content')

<h2 style="text-align: center; margin-top: 2rem;">Els nostres patrocinadors</h2>

<div class="contenidor-patrocinadors">
    @for ($i = 1; $i <= 12; $i++)
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('patrocinadors.mostra', ['id' => $i]) }}">
                    <button>PATROCINADOR {{ $i }}</button>
                </a>
                <img src="{{ asset("images/patrocinadors/patro$i.jpg") }}" alt="Patrocinador {{ $i }}">
            </div>
            <div class="MedioA">
                <p>Descripció breu del patrocinador {{ $i }} i la seva aportació al club.</p>
            </div>
        </div>
    @endfor
</div>

@endsection
