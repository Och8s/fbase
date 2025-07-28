@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sixBlocs.css') }}">
@endsection

@section('content')
<div class="Introduccio1">
    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('escola.formacio') }}"><button>FORMACIÓ</button></a>
            <img src="{{ asset('images/escola/formacio.jpg') }}" alt="Formació">
        </div>
        <div class="MedioA">
            <p>Descobreix com treballem la formació dels jugadors des de la base.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('escola.equips') }}"><button>EQUIPS</button></a>
            <img src="{{ asset('images/escola/equip.jpg') }}" alt="Equips">
        </div>
        <div class="MedioA">
            <p>Consulta tots els equips que formen part de l’Escola de Futbol.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('escola.estil') }}"><button>ESTIL</button></a>
            <img src="{{ asset('images/escola/estil.jpg') }}" alt="Estil de joc">
        </div>
        <div class="MedioA">
            <p>Línies mestres del nostre estil de joc i comportament dins i fora del camp.</p>
        </div>
    </div>
</div>

<div class="Introduccio2">
    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('escola.metodologia') }}"><button>METODOLOGIA</button></a>
            <img src="{{ asset('images/escola/metodologia.jpg') }}" alt="Metodologia">
        </div>
        <div class="MedioA">
            <p>Metodologia pròpia basada en valors, tècnica i cohesió d’equip.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('escola.accesEntrenador') }}"><button>ACCÉS ENTRENADOR</button></a>
            <img src="{{ asset('images/escola/mister.jpg') }}" alt="Entrenador">
        </div>
        <div class="MedioA">
            <p>Accés privat per als entrenadors de l’Escola amb recursos i seguiment.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('escola.accesCoordinador') }}"><button>ACCÉS COORDINADOR</button></a>
            <img src="{{ asset('images/escola/coordinador.webp') }}" alt="Coordinador">
        </div>
        <div class="MedioA">
            <p>Accés per a coordinadors per gestionar les categories i equips.</p>
        </div>
    </div>
</div>
@endsection
