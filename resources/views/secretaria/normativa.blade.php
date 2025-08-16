@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/secretaria/normativa.css') }}">
@endsection

@section('content')

{{-- ROW 1: Reglaments generals --}}
<div class="Introduccio1">

  {{-- RFEF --}}
  <div class="Apartat">
    <div class="apartat-titol">
      <h3>REGLAMENT RFEF</h3>
      <img src="{{ asset('images/secretaria/fed.png') }}" alt="Reglament RFEF">
    </div>
    <p class="apartat-desc">
      Normes generals de competició i disciplina aplicables a tot l’àmbit estatal.
    </p>
    <div class="docu-row">
      <a class="btn-docu" href="{{ asset('images/secretaria/ReglamentRFEF.pdf') }}" target="_blank" rel="noopener">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- FCF --}}
  <div class="Apartat">
    <div class="apartat-titol">
      <h3>REGLAMENT FCF</h3>
      <img src="{{ asset('images/secretaria/cat.png') }}" alt="Reglament FCF"   class="img-cat">
    </div>
    <p class="apartat-desc">
      Adaptacions i disposicions pròpies de Catalunya per a totes les categories.
    </p>
    <div class="docu-row">
      <a class="btn-docu" href="{{ asset('images/secretaria/ReglamentFCF.pdf') }}" target="_blank" rel="noopener">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- Pla competició Tarragona --}}
  <div class="Apartat">
    <div class="apartat-titol">
      <h3>PLA DE COMPETICIÓ</h3>
<img src="{{ asset('images/secretaria/cat.png') }}"    alt="Pla competició Tarragona"     class="img-cat">
    </div>
    <p class="apartat-desc">
      Calendari marc, bases de competició i criteris específics per la competició.
    </p>
    <div class="docu-row">
      <a class="btn-docu" href="{{ asset('images/secretaria/PlaCompeticioTarragona.pdf') }}" target="_blank" rel="noopener">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

</div>

{{-- ROW 2: Normativa interna del club / equips / instal·lacions --}}
<div class="Introduccio2">

  {{-- Règim intern --}}
  <div class="Apartat">
    <div class="apartat-titol">
      <h3>RÈGIM INTERN DEL CLUB</h3>
      <img src="{{ asset('imagesGeneral/redondoClub.webp') }}" alt="Reglament intern"  class="img-club">
    </div>
    <p class="apartat-desc">
      Document amb els <strong>valors, compromisos i normes de convivència</strong> del nostre club.
    </p>
    <div class="docu-row">
      <a class="btn-docu" href="{{ asset('images/secretaria/RegimInternClub.pdf') }}" target="_blank" rel="noopener">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- Normativa equips (accés restringit) --}}
  <div class="Apartat">
    <div class="apartat-titol">
      <h3>NORMATIVA EQUIPS</h3>
            <img src="{{ asset('imagesGeneral/escolaLogoTrBlack.png')}}" alt="Logo Escola">

    </div>

    <p class="apartat-desc">
      Protocols de partit, entrenaments i gestió de plantilles.
    </p>
    <div class="docu-row">
      <a class="btn-docu" href="#" onclick="return false;">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- Normativa instal·lacions (accés restringit) --}}
  <div class="Apartat">
    <div class="apartat-titol">
      <h3 >NORMATIVA <br>INSTAL·LACIONS </h3>
      <img src="{{ asset('imagesGeneral/Vilaseca.png')}}" alt="Logo instal·lacions" class="img-vila">
    </div>
    <p class="apartat-desc">
   Ús d’espais, horaris, material i seguretat.
    </p>
    <div class="docu-row">
      <a class="btn-docu" href="#" onclick="return false;">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

</div>

@endsection
