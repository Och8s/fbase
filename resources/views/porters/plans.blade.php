@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/porters/plans.css') }}">
@endsection

@section('content')

<div class="plans-wrapper">

  <h2 class="titol-plans">PLANS D'ENTRENAMENT</h2>

  <div class="plans-grid">
    {{-- PLAN 1 DIA --}}
    <div class="plan-card card-box">
      <div class="plan-head">
        <h3>1 DIA a la setmana</h3>
        <span class="badge">PACK BÀSIC</span>
      </div>

      <ul class="plan-features">
        <li>1 sessió setmanal</li>
        <li>Grups per edat i nivell</li>
        <li>Treball tècnic i coordinació</li>
        <li>Seguiment bàsic de progressos</li>
      </ul>

      <div class="plan-bottom push-bottom">
        <div class="plan-price">
          <span class="price">30€</span>
          <span class="per">/ mes</span>
        </div>
        <p class="club-discount">Pack més econòmic</p>
      </div>
    </div>

    {{-- PLAN 2 DIES --}}
    <div class="plan-card card-box featured">
      <div class="plan-head">
        <h3>2 DIES a la setmana</h3>
        <span class="badge badge-pro">MÉS POPULAR</span>
      </div>

      <ul class="plan-features">
        <li>2 sessions setmanals</li>
        <li>Grups per edat i nivell</li>
        <li>Millora tècnica accelerada</li>
        <li>Feedback i seguiment ampliat</li>
      </ul>

      <div class="plan-bottom push-bottom">
        <div class="plan-prices">
          <div class="price-line">
            <span class="price">50€</span><span class="per">/ mes</span>
          </div>
          <div class="price-line club">
            <span class="price">40€</span><span class="per">/ mes</span>
            <span class="note">per a jugadors del club</span>
          </div>
        </div>
        <p class="club-discount">A més, els jugadors del club tenen descompte a la quota del club.</p>
      </div>
    </div>
  </div> {{-- /.plans-grid --}}

  <p class="intro-plans">
    * L’horari dependrà del nivell i l’edat del jugador o jugadora. Els entrenadors assignaran el grup i l’horari més adient.
  </p>

  {{-- Comparativa opcional --}}
  <div class="comparativa card-box">
    <h4 class="comparativa-title">Comparativa ràpida</h4>
    <div class="comparativa-grid">
      <div class="comparativa-row header">
        <div></div>
        <div>1 dia</div>
        <div>2 dies</div>
      </div>
      <div class="comparativa-row">
        <div>Sessions/setmana</div>
        <div>1</div>
        <div>2</div>
      </div>
      <div class="comparativa-row">
        <div>Seguiment</div>
        <div>Bàsic</div>
        <div>Ampliat</div>
      </div>
      <div class="comparativa-row">
        <div>Quota mensual</div>
        <div>30€</div>
        <div>50€ (40€ jugadors del club)</div>
      </div>
    </div>
  </div>
<p class="contacte-telf">
TELÈFON ESCOLA DE PORTERS - 687 324 241  </p>
</div> {{-- /.plans-wrapper --}}

@endsection
