@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sixBlocs.css') }}">
@endsection

@section('content')
<div class="Introduccio1">
    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('secretaria.oficina') }}"><button>OFICINA</button></a>
            <img src="{{ asset('images/secretaria/ofice.avif') }}" alt="Oficina">
        </div>
        <div class="MedioA">
            <p>Horaris d’atenció, ubicació i serveis administratius del club.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('secretaria.inscripcions') }}"><button>INSCRIPCIONS</button></a>
            <img src="{{ asset('images/secretaria/inscripcion.jpg') }}" alt="Inscripcions">
        </div>
        <div class="MedioA">
            <p>Informació i requisits per a fer la inscripció a l’Escola de Futbol.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('secretaria.merchandasing') }}"><button>MERCHANDASING</button></a>
            <img src="{{ asset('images/secretaria/vestuari.jpg') }}" alt="Merchandasing">
        </div>
        <div class="MedioA">
            <p>Equipacions, roba esportiva i material oficial del club.</p>
        </div>
    </div>
</div>

<div class="Introduccio2">
    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('secretaria.normativa') }}"><button>NORMATIVA</button></a>
            <img src="{{ asset('images/secretaria/normativa.webp') }}" alt="Normativa">
        </div>
        <div class="MedioA">
            <p>Consulta les normes de funcionament del club i conducta esportiva.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('secretaria.contacte') }}"><button>CONTACTE</button></a>
            <img src="{{ asset('images/secretaria/contacteofi.png') }}" alt="Contacte Secretaria">
        </div>
        <div class="MedioA">
            <p>Posa’t en contacte amb l’equip administratiu per qualsevol dubte.</p>
        </div>
    </div>

    <div class="Apartat">
        <div class="MedioA">
            <a href="{{ route('secretaria.acces') }}"><button>ACCÉS SECRETARIA</button></a>
            <img src="{{ asset('images/secretaria/secretaria.jpg') }}" alt="Accés Secretaria">
        </div>
        <div class="MedioA">
            <p>Espai privat per a l’equip de secretaria i gestió interna.</p>
        </div>
    </div>
</div>
@endsection
