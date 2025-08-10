@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/one_fourBlocs.css') }}">
@endsection

@section('content')
<div class="modelEquip">
    <!-- FOTO GRAN - 60% -->
    <div class="model1">
        <div class="ApartatX4">
                <div class="MedioA fotoGran">
                    <img class="plantillaFoto"
                         src="{{ asset('images/secretaria/uniforme.avif') }}"
                         alt="Primera equipació C.F. Vila-seca">
                </div>

        </div>
        <h3>PRIMERA EQUIPACIÓ C.F. VILA-SECA TEMPORADA 2024/25</h3>
    </div>

    <!-- BOTONS FUNCIONALS - 40% -->
    <div class="model2">
        <div class="Apartat">
            <div class="MedioA">
                {{-- ON COMPRAR --}}
                <a href="{{ route('secretaria.merchandasing') }}">
                    <button>ON COMPRAR L'EQUIPACIÓ</button>
                </a>
<img src="{{ asset('images/secretaria/logoWALA.svg') }}" alt="On comprar equipacions">
            </div>
            <div class="MedioA">
                {{-- INSTRUCCIONS DE COMPRA --}}
                <a href="{{ route('secretaria.merchandasing') }}">
                    <button>INSTRUCCIONS DE COMPRA</button>
                </a>
<img src="{{ asset('images/secretaria/instCompra.avif') }}" alt="Instruccions de compra">
            </div>
        </div>

        <div class="Apartat">
            <div class="MedioA">
                {{-- DESCOMPTES WALA --}}
                <a href="{{ route('secretaria.merchandasing') }}">
                    <button>DESCOMPTES WALA</button>
                </a>
<img src="{{ asset('images/secretaria/descuentos.png') }}" alt="Descomptes Wala">
            </div>
            <div class="MedioA">
                {{-- SEGONA EQUIPACIÓ --}}
                <a href="{{ route('secretaria.merchandasing') }}">
                    <button>SEGONA EQUIPACIÓ</button>
                </a>
<img src="{{ asset('images/secretaria/uniforme2.jpg') }}" alt="Segona equipació">
            </div>
        </div>
    </div>
</div>
@endsection
