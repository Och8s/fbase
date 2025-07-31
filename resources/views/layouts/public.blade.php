<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escola de Futbol</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @yield('styles')
</head>
<body>
<div class="topbar" style="background-color: #001f4d; color: white; padding: 10px; text-align: right;">
        <div class="container">
            @auth
                Benvingut, {{ Auth::user()->name }} |
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   style="color: white; text-decoration: underline;">
                   Tancar sessió
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth

            @guest
                Estàs visualitzant la web com a convidat!
            @endguest
        </div>
    </div>

    <header class="text-center py-4">
        <h1>CLUB DE FUTBOL - ESCOLA DE FUTBOL BASE</h1>
    </header>

    <div class="container mt-4">
        <div class="logo-acces">
            <div class="logo-escola-container">
                <img src="{{ asset('imagesGeneral/escolaLogoPngWhite.png') }}" alt="Logo Escola" class="logo-escola-centre">
            </div>
            <div class="logo-container">
                <img src="{{ asset('imagesGeneral/LOGO-NEW01.png') }}" alt="Logo Club" class="logo-escola">
            </div>
            <div class="acces-usuaris">
                <a href="{{ route('login') }}" class="btn-acces">Accés Usuaris</a>
            </div>
        </div>

        <nav class="nav-publica">
            <hr class="linea">
            <ul>
               <li class="desplegable">
@php use Illuminate\Support\Str; @endphp
<a href="{{ route('club.index') }}"
   class="{{ Str::startsWith(Request::path(), 'club') || Str::startsWith(Request::path(), 'vista') ? 'active' : '' }}">
   CLUB
</a>



  <div class="desplegableContingut">
    <a href="{{ route('club.noticies') }}">Notícies</a>
    <a href="{{ route('club.qui') }}">Qui som?</a>
    <a href="{{ route('club.objectius') }}">Objectius</a>
    <a href="{{ route('club.events') }}">Activitats i esdeveniments</a>
    <a href="{{ route('club.soci') }}">Fes-te soci</a>
    <a href="{{ route('club.accesSoci') }}">Notificacions per a socis</a>
  </div>
</li>
                <li class="desplegable">
  <a href="{{ route('escola.index') }}"
     class="{{ request()->is('escola*') ? 'active' : '' }}">
     ESCOLA
  </a>
  <div class="desplegableContingut">
    <a href="{{ route('escola.formacio') }}">Formació</a>
    <a href="{{ route('escola.equips') }}">Equips</a>
    <a href="{{ route('escola.estil') }}">Estil</a>
    <a href="{{ route('escola.metodologia') }}">Metodologia</a>
    <a href="{{ route('escola.accesEntrenador') }}">Accés Entrenador</a>
    <a href="{{ route('escola.accesCoordinador') }}">Accés Coordinador</a>
  </div>
                <li class="desplegable"><a href="{{ route('primer.index') }}"
   class="{{ request()->is('primer*') ? 'active' : '' }}">
   PRIMER EQUIP
</a>

                    <div class="desplegableContingut">
                        <a href="{{ route('primer.plantilla') }}">Plantilla</a>
                        <a href="{{ route('primer.calendari') }}">Calendari</a>
                        <a href="{{ route('primer.jornada') }}">Jornada</a>
                        <a href="{{ route('primer.resultats') }}">Resultats</a>
                        <a href="{{ route('primer.classificacio') }}">Classificació</a>
                    </div>
                </li>
<li class="desplegable">
  <a href="{{ route('segon.index') }}"
     class="{{ request()->is('segon*') ? 'active' : '' }}">
     SEGON EQUIP
  </a>
                    <div class="desplegableContingut">
                        <a href="{{ route('segon.plantilla') }}">Plantilla</a>
                        <a href="{{ route('segon.calendari') }}">Calendari</a>
                        <a href="{{ route('segon.jornada') }}">Jornada</a>
<a href="{{ route('segon.resultats') }}">Resultats</a>
                        <a href="{{ route('segon.classificacio') }}">Classificació</a>
                    </div>
                </li>
                <li class="desplegable">  <a href="{{ route('porters.index') }}"
     class="{{ request()->is('porters*') ? 'active' : '' }}">
     ESCOLA DE PORTERS
  </a>

                    <div class="desplegableContingut">
                        <a href="{{ route('porters.formacio') }}">Formació i metodologia</a>
                        <a href="{{ route('porters.horari') }}">Horari, calendari i esdeveniments</a>
                        <a href="{{ route('porters.entrenadors') }}">Entrenadors</a>
                        <a href="{{ route('porters.plans') }}">Plans i tarifes</a>
                        <a href="{{ route('porters.contacte') }}">Contacte</a>
                    </div>
                </li>
               <li class="desplegable">
  <a href="{{ route('secretaria.index') }}"
     class="{{ request()->is('secretaria*') ? 'active' : '' }}">
     SECRETARIA
  </a>
  <div class="desplegableContingut">
    <a href="{{ route('secretaria.oficina') }}">Oficina</a>
    <a href="{{ route('secretaria.inscripcions') }}">Inscripcions</a>
    <a href="{{ route('secretaria.merchandasing') }}">Merchandasing</a>
    <a href="{{ route('secretaria.normativa') }}">Normativa</a>
    <a href="{{ route('secretaria.contacte') }}">Contacte</a>
    <a href="{{ route('secretaria.acces') }}">Accés Secretaria</a>
  </div>
</li>
                <li class="desplegable"> <a href="{{ route('historia.index') }}"
     class="{{ request()->is('historia*') ? 'active' : '' }}">
     HISTÒRIA
  </a>
                    <div class="desplegableContingut">
                        <a href="{{ route('historia.ressenya') }}">Ressenya històrica</a>
                        <a href="{{ route('historia.cronologia') }}">Cronologia d'èxits</a>
                        <a href="{{ route('historia.fotografies') }}">Fotografies històriques</a>
                        <a href="{{ route('historia.envians') }}">Envia'ns la teva foto</a>
                    </div>
                </li>
<li>
    <a href="{{ route('patrocinadors.index') }}"
       class="{{ request()->is('patrocinadors*') ? 'active' : '' }}">
       PATROCINADORS
    </a>
</li>
            </ul>
            <hr class="linea">
        </nav>
    </div>

    @yield('content')

    <footer class="footer-public">
       <p>
  📞 <a href="tel:+34606273173">606 27 31 73</a> |
  ✉️ <a href="mailto:administracio@cfvila-seca.com">administracio@cfvila-seca.com</a>
</p>

        <div class="social-icons">
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
        </div>
    </footer>

</body>
</html>
