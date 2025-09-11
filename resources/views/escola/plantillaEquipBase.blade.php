@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/one_fourBlocs.css') }}">

  <link rel="stylesheet" href="{{ asset('css/escola/equipsPlantilla.css') }}">

<style>

/* mini estilos para la línea de metadatos */
.subtitol-equip {
    margin: 6px 0 18px 0;
    display: flex;
    justify-content: center; /* centra en horizontal */
    gap: .5rem;
    flex-wrap: wrap;
    text-align: center; /* asegura centrado en varias líneas */
}
.subtitol-equip .badge {
    display: inline-block;
    padding: .25rem .6rem;
    border-radius: 999px;
    background: #eef4ff;
    color: #003366;
    font-size: .85rem;
    border: 1px solid #d7e3ff;
}

</style>
@endsection

@section('content')

@php
    $cat = optional($equip->categoria)->nom;
    $sub = optional($equip->subcategoria)->nom;
    $mod = optional($equip->modalitat)->nom;

    // Título: SUBCATEGORIA + NOM
    $titol = trim(strtoupper(($sub ? $sub.' ' : '').($equip->nom ?? '')));

    // Map de divisió (enum) -> texto legible
    $mapDiv = [
        '2_div'   => '2a Divisió',
        '1_div'   => '1a Divisió',
        'prefer'  => 'Preferent',
        'div_hon' => 'Divisió d’Honor',
        'nacional'=> 'Nacional',
    ];
    $divisioTxt = $equip->divisio ? ($mapDiv[$equip->divisio] ?? strtoupper($equip->divisio)) : null;

    // Foto (placeholder si no hay)
    $foto = !empty($equip->foto) ? asset($equip->foto) : asset('images/escola/placeholder_equip.jpg');
@endphp

<h2 class="titol-noticies">{{ $titol }}</h2>

@if ($cat || $divisioTxt)
  <p class="subtitol-equip">
    @if ($cat)
      <span class="badge">{{ strtoupper($cat) }}</span>
    @endif
    @if ($divisioTxt)
      <span class="badge">{{ $divisioTxt }}</span>
    @endif
  </p>
@endif

<div class="modelEquip">

    <!-- FOTO GRAN - 60% -->
    <div class="model1">
    <div class="ApartatX4">
        <div class="MedioA fotoGran" id="btnJugadors"
             data-titol="{{ optional($equip->subcategoria)->nom ?? optional($equip->categoria)->nom }} {{ $equip->nom }}"
             data-jugadors='@json($equip->jugadors->map(function($j){ return ["dorsal"=>$j->dorsal,"nom"=>$j->nom,"cognoms"=>$j->cognoms]; }))'
             style="cursor:pointer;">
            <img class="plantillaFoto"
                 src="{{ $foto }}"
                 alt="Plantilla {{ optional($equip->subcategoria)->nom }} {{ $equip->nom }}">
            <span class="text-over-image">Coneix els jugadors</span>
        </div>
    </div>

    <h3>TEMPORADA 2024/25</h3>
</div>


    <!-- BOTONES FUNCIONALES - 40% -->
    <div class="model2">
        <div class="Apartat">
            <div class="MedioA">
                <a href="#" onclick="return false;">
                    <button>CLASSIFICACIÓ</button>
                </a>
                <img src="{{ asset('images/primer_equip/classificacio.jpeg') }}" alt="Classificació">
            </div>
            <div class="MedioA">
                <a href="#" onclick="return false;">
                    <button>JORNADA</button>
                </a>
                <img src="{{ asset('images/primer_equip/jornada.jpeg') }}" alt="Jornada">
            </div>
        </div>
        <div class="Apartat">
            <div class="MedioA">
                <a href="#" onclick="return false;">
                    <button>RESULTATS</button>
                </a>
                <img src="{{ asset('images/primer_equip/resultats.jpg') }}" alt="Resultats">
            </div>
            <div class="MedioA">
                <a href="#" onclick="return false;">
                    <button>CALENDARI</button>
                </a>
                <img src="{{ asset('images/primer_equip/calendari.jpg') }}" alt="Calendari">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/sweetAlertPlantillaEquip.js') }}"></script>
@endsection
