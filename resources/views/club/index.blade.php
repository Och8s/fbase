@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
@endsection

@section('content')

<header class="text-center py-4">
    <h1>CLUB DE FUTBOL - ESCOLA DE FUTBOL BASE <h1>
</header>
<div class="container mt-4">
    {{--LOGO I ACCES  --}}
    <div class="logo-acces">
        <div class="logo-container">
            <img src="{{ asset('imagesGeneral/LOGO-NEW01.png') }}" alt="Logo" class="logo-escola">
        </div>
        <div class="acces-usuaris">
            <a href="{{ route('login') }}" class="btn-acces">Accés Usuaris</a>
        </div>
    </div>

    <nav class="nav-publica">
        <hr class="linea">
        <ul>
            <li class="desplegable"><a href="{{ route('club.index') }}">CLUB</a>
                <div class="desplegableContingut">
                    <a href="{{ route('club.noticies') }}">Notícies</a>
                    <a href="{{ route('club.qui') }}">Qui som?</a>
                    <a href="{{ route('club.objectius') }}">Objectius</a>
                    <a href="{{ route('club.events') }}">Activitats i esdeveniments</a>
                    <a href="{{ route('club.soci') }}">Fes-te soci</a>
                    <a href="{{ route('club.accesSoci') }}">Notificacions per a socis</a>
                </div>
            </li>
            <li class="desplegable"><a href="{{ route('escola.index') }}">ESCOLA</a>
                <div class="desplegableContingut">
                    <a href="{{ route('escola.formacio') }}">Formació</a>
                    <a href="{{ route('escola.equips') }}">Equips</a>
                    <a href="{{ route('escola.estil') }}">Estil</a>
                    <a href="{{ route('escola.metodologia') }}">Metodologia</a>
                    <a href="{{ route('escola.accesEntrenador') }}">Accés Entrenador</a>
                    <a href="{{ route('escola.accesCoordinador') }}">Accés Coordinador</a>
                </div>
            </li>
            <li class="desplegable"><a href="{{ route('primer.index') }}">PRIMER EQUIP</a>
                <div class="desplegableContingut">
                    <a href="{{ route('primer.plantilla') }}">Plantilla</a>
                    <a href="{{ route('primer.calendari') }}">Calendari</a>
                    <a href="{{ route('primer.jornada') }}">Jornada</a>
                    <a href="{{ route('primer.resultats') }}">Resultats</a>
                    <a href="{{ route('primer.classificacio') }}">Classificació</a>
                </div>
            </li>
            <li class="desplegable"><a href="{{ route('segon.index') }}">SEGON EQUIP</a>
                <div class="desplegableContingut">
                    <a href="{{ route('segon.plantilla') }}">Plantilla</a>
                    <a href="{{ route('segon.calendari') }}">Calendari</a>
                    <a href="{{ route('segon.jornada') }}">Jornada</a>
                    <a href="{{ route('segon.resultat') }}">Resultats</a>
                    <a href="{{ route('segon.classificacio') }}">Classificació</a>
                </div>
            </li>
            <li class="desplegable"><a href="{{ route('porters.index') }}">ESCOLA DE PORTERS</a>
                <div class="desplegableContingut">
                    <a href="{{ route('porters.formacio') }}">Formació i metodologia</a>
                    <a href="{{ route('porters.horari') }}">Horari, calendari i esdeveniments</a>
                    <a href="{{ route('porters.entrenadors') }}">Entrenadors</a>
                    <a href="{{ route('porters.plans') }}">Plans i tarifes</a>
                    <a href="{{ route('porters.contacte') }}">Contacte</a>
                </div>
            </li>
            <li class="desplegable"><a href="{{ route('secretaria.index') }}">SECRETARIA</a>
                <div class="desplegableContingut">
                    <a href="{{ route('secretaria.oficina') }}">Oficina</a>
                    <a href="{{ route('secretaria.inscripcions') }}">Inscripcions</a>
                    <a href="{{ route('secretaria.merchandasing') }}">Merchandasing</a>
                    <a href="{{ route('secretaria.normativa') }}">Normativa</a>
                    <a href="{{ route('secretaria.contacte') }}">Contacte</a>
                    <a href="{{ route('secretaria.acces') }}">Accés Secretaria</a>
                </div>
            </li>
            <li class="desplegable"><a href="{{ route('historia.index') }}">HISTÒRIA</a>
                <div class="desplegableContingut">
                    <a href="{{ route('historia.ressenya') }}">Ressenya històrica</a>
                    <a href="{{ route('historia.cronologia') }}">Cronologia d'èxits</a>
                    <a href="{{ route('historia.fotografies') }}">Fotografies històriques</a>
                    <a href="{{ route('historia.envians') }}">Envia'ns la teva foto</a>
                </div>
            </li>
            <li><a href="{{ route('patrocinadors.index') }}">PATROCINADORS</a></li>
        </ul>
        <hr class="linea">
    </nav>
</div>


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
                <a href="{{ route('club.qui') }}"><button>QUI SOM?</button></a>
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
<footer class="footer-public">
    <p>📞 606 27 31 73 | ✉️ administracio@cfvila-seca.com</p>
    <div class="social-icons">
        <a href="https://facebook.com" target="_blank">Facebook</a> |
        <a href="https://instagram.com" target="_blank">Instagram</a>
    </div>
</footer>


@endsection
