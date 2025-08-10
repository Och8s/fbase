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
    <h3 class="apartat-titol">REGLAMENT RFEF<img src="{{ asset('images/secretaria/fed.png') }}" alt="Reglament RFEF">
</h3>
    <p class="apartat-desc">
      Normes generals de competició i disciplina aplicables a tot l’àmbit estatal.
    </p>
        </p>
    <div class="docu-row">
      <a class="btn-docu" href="{{ asset('images/secretaria/ReglamentRFEF.pdf') }}" target="_blank" rel="noopener">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- FCF --}}
  <div class="Apartat">
    <h3 class="apartat-titol">REGLAMENT FCF<img src="{{ asset('images/secretaria/cat.png') }}" alt="Reglament RFEF">
</h3>
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
    <h3 class="apartat-titol">PLA DE COMPETICIÓ TARRAGONA</h3>
    <p class="apartat-desc">
      Calendari marc, bases de competició i criteris específics per a les competicions de <strong>Tarragona</strong>.
    </p>
    <div class="docu-row">
      <img src="{{ asset('images/secretaria/pla_competicio_tarragona.jpg') }}" alt="Pla de competició Tarragona">
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
    <h3 class="apartat-titol">REGIM INTERN DEL CLUB<img src="{{ asset('imagesGeneral.LOGO-NEW01.png') }}" alt="Reglament RFEF">
</h3>
    <p class="apartat-desc">
      Document amb els <strong>valors, compromisos i normes de convivència</strong> del nostre club.
    </p>
    <div class="docu-row">
      <img src="{{ asset('images/secretaria/regim_intern.jpg') }}" alt="Régim Intern del Club">
      <a class="btn-docu" href="{{ asset('images/secretaria/RegimInternClub.pdf') }}" target="_blank" rel="noopener">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- Normativa equips (accés restringit) --}}
  <div class="Apartat">
    <h3 class="apartat-titol">NORMATIVA EQUIPS</h3>
    <p class="apartat-desc">
      <em>Accés exclusiu per a entrenadors del club.</em> Protocols de partit, entrenaments i gestió de plantilles.
    </p>
    <div class="docu-row">
      <img src="{{ asset('images/secretaria/normativa_equips.jpg') }}" alt="Normativa Equips">
      <a class="btn-docu" href="#" onclick="return false;">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

  {{-- Normativa instal·lacions (accés restringit) --}}
  <div class="Apartat">
    <h3 class="apartat-titol">NORMATIVA INSTAL·LACIONS</h3>
    <p class="apartat-desc">
      <em>Accés exclusiu per a coordinadors del club.</em> Ús d’espais, horaris, material i seguretat.
    </p>
    <div class="docu-row">
      <img src="{{ asset('images/secretaria/normativa_installacions.jpg') }}" alt="Normativa Instal·lacions">
      <a class="btn-docu" href="#" onclick="return false;">
        <button>VEURE DOCU</button>
      </a>
    </div>
  </div>

</div>

@endsection
