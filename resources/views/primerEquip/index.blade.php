@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/one_fourBlocs.css') }}">
@endsection

@section('content')
<div class="modelEquip">
    <!-- FOTO GRAN - 60% -->
    <div class="model1">
        <div class="ApartatX4">
            <a href="{{ route('primer.plantilla') }}" class="link-foto-gran">
                <div class="MedioA fotoGran">
                    <img class="plantillaFoto" src="{{ asset('images/primer_equip/plantilla1e.jpg') }}" alt="Plantilla 1r Equip">
                    <span class="text-over-image">Coneix la Plantilla</span>
                </div>
            </a>
        </div>
        <h3>PRIMER EQUIP C.F. VILA-SECA TEMPORADA 2024/25</h3>
    </div>

    <!-- BOTONS FUNCIONALS - 40% -->
    <div class="model2">
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('primer.classificacio') }}">
                    <button>CLASSIFICACIÓ</button>
                </a>
                <img src="{{ asset('images/primer_equip/classificacio.jpeg') }}" alt="Classificació">
            </div>
            <div class="MedioA">
                <a href="{{ route('primer.jornada') }}">
                    <button>JORNADAX</button>
                </a>
                <img src="{{ asset('images/primer_equip/jornada.jpeg') }}" alt="Jornada">
            </div>
        </div>
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('primer.resultats') }}">
                    <button>RESULTATS</button>
                </a>
                <img src="{{ asset('images/primer_equip/resultats.jpg') }}" alt="Resultats Equip">
            </div>
            <div class="MedioA">
                <a href="{{ route('primer.calendari') }}">
                    <button>CALENDARI</button>
                </a>
                <img src="{{ asset('images/primer_equip/calendari.jpg') }}" alt="Calendari">
            </div>
        </div>
    </div>
</div>
@endsection
