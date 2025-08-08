@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/one_fourBlocs.css') }}">
@endsection

@section('content')
<div class="modelEquip">
    <!-- FOTO GRAN A L'ESQUERRA -->
    <div class="model1">
        <div class="ApartatX4">
            <div class="MedioA fotoGran">
                <img class="plantillaFoto" src="{{ asset('images/porters/portersPrincipal.jpg') }}" alt="Escola de Porters">
<span class="text-over-image">
        <img src="{{ asset('images/porters/logoPR.jpg') }}" alt="Logo PR" class="logoPorter2">
        Coneix en Paco Rodri
</span>
            </div>
        </div>
<h3 class="h3SenseMargin">Telèfon de contacte 687 324 241</h3>

        <img src="{{ asset('images/porters/logoAnt.png') }}" alt="Logo Escola 1" class="logoPorter1">


    </div>

    <!-- 4 BOTONS A LA DRETA -->
    <div class="model2">
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('porters.metodologiaPorters') }}">
                    <button>FORMACIÓ I METODOLOGIA</button>
                </a>
                <img src="{{ asset('images/porters/metodoPorters.jpg') }}" alt="Formació i metodologia">
            </div>
            <div class="MedioA">
<a href="{{ route('porters.horariCalendari') }}">
                    <button>HORARI, CALENDARI I ESDEVENIMENTS</button>
                </a>

                <img src="{{ asset('images/porters/forma2porters.jpg') }}" alt="Horari, calendari i esdeveniments">
            </div>
        </div>
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('porters.entrenadors') }}">
                    <button>CONEIX ELS ENTRENADORS</button>
                </a>
                <img src="{{ asset('images/porters/conocePorteros.jpg') }}" alt="Coneix els entrenadors">
            </div>
            <div class="MedioA">
                <a href="{{ route('porters.plans') }}">
                    <button>PLANS I TARIFES</button>
                </a>
                <img src="{{ asset('images/porters/calendariPorters.jpg') }}" alt="Plans i tarifes">
            </div>
        </div>
    </div>
</div>
@endsection
