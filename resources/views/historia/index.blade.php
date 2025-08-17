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
  <a href="{{ route('historia.jugadors') }}" class="cover-link" aria-label="Jugadors històrics">
    <img class="plantillaFoto" src="{{ asset('images/historia/historia01.jpg') }}" alt="Història del club">
    <span class="text-over-image">Coneix els nostres jugadors més il·lustres</span>
  </a>
</div>

        </div>
        <h3>HISTÒRIA DEL CLUB C.F. VILA-SECA</h3>
    </div>

    <!-- 4 BOTONS A LA DRETA -->
    <div class="model2">
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('historia.ressenya') }}">
                    <button>RESSENYA HISTÒRICA</button>
                </a>
                <img src="{{ asset('images/historia/ressenya.png') }}" alt="Ressenya històrica">
            </div>
            <div class="MedioA">
                <a href="{{ route('historia.cronologia') }}">
                    <button>CRONOLOGIA D'ÈXITS</button>
                </a>
                <img src="{{ asset('images/historia/crono.jpg') }}" alt="Cronologia d'èxits">
            </div>
        </div>
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('historia.fotografies') }}">
                    <button>FOTOGRAFIES HISTÒRIQUES</button>
                </a>
                <img src="{{ asset('images/historia/historia03.jpg') }}" alt="Fotografies històriques">
            </div>
            <div class="MedioA">
                <a href="{{ route('historia.envians') }}">
                    <button>ENVIA'NS LA TEVA FOTO</button>
                </a>
                <img src="{{ asset('images/historia/enviafoto.jpg') }}" alt="Envia'ns la teva foto">
            </div>
        </div>
    </div>
</div>
@endsection
