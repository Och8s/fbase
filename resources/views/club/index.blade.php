@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
@endsection

@section('content')

    <div class="Introduccio1">
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('club.noticies') }}"><button>NOTÍCIES</button></a>
                <img src="{{ asset('images/club/noticies.webp') }}" alt="Notícies">
            </div>
            <div class="MedioA">
                <p>Notícies més importants referents al club de Futbol Vila-seca i del seu entorn.</p>
            </div>
        </div>

        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('club.qui_som') }}"><button>QUI SOM?</button></a>
                <img src="{{ asset('images/club/presentacion.jpg') }}" alt="Qui som?">
            </div>
            <div class="MedioA">
                <p>Introducció al nostre club, filosofia i vinculació amb el poble.</p>
            </div>
        </div>

        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('club.objectius') }}"><button>OBJECTIUS</button></a>
                <img src="{{ asset('images/club/Objetivos.jpg') }}" alt="Objectius">
            </div>
            <div class="MedioA">
                <p>Exposem els objectius del nostre club i de la nostra escola de futbol base.</p>
            </div>
        </div>
    </div>

    <div class="Introduccio2">
        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('club.events') }}"><button>ACTIVITATS I EVENTS</button></a>
                <img src="{{ asset('images/club/Campus.jpg') }}" alt="Events">
            </div>
            <div class="MedioA">
                <p>Informació sobre els esdeveniments de la temporada 24/25.</p>
            </div>
        </div>

        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('club.soci') }}"><button>FES-TE'N SOCI</button></a>
                <img src="{{ asset('images/club/soci.jpg') }}" alt="Fes-te soci">
            </div>
            <div class="MedioA">
                <p>Fes-te soci del Vila-seca i participa activament al club.</p>
            </div>
        </div>

        <div class="Apartat">
            <div class="MedioA">
                <a href="{{ route('club.accesSoci') }}"><button>NOTIFICACIONS PER A SOCIS</button></a>
                <img src="{{ asset('images/club/noti.jpg') }}" alt="Notificacions">
            </div>
            <div class="MedioA">
                <p>Accés exclusiu per a socis amb notificacions i enquestes.</p>
            </div>
        </div>
    </div>
</div>




@endsection
