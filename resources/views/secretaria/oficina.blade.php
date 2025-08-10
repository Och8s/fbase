@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/club/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/secretaria/oficina.css') }}">
@endsection

@section('content')

<div class="sec-wrapper">

<div class="card-box sec-horari-full">
  <h2 class="titol-noticies">HORARI D'OFICINA</h2>

  <div class="horari-grid">
    <div class="dia">
      <h4 class="subtitol-dia">DILLUNS</h4>
      <p>de 17:30 h a 20:30 h</p>
    </div>
    <div class="dia">
      <h4 class="subtitol-dia">DIMECRES</h4>
      <p>de 17:30 h a 20:30 h</p>
    </div>
    <div class="dia">
      <h4 class="subtitol-dia">DIVENDRES</h4>
      <p>de 17:30 h a 20:30 h</p>
    </div>
  </div>
</div>


  {{-- SEGONA FILA: 55% UBICACIÓ | 45% TELÈFONS --}}
  <div class="sec-row-ubitel">
    {{-- UBICACIÓ (55%) --}}
    <div class="sec-ubi card-box">
          <h2 class="titol-noticies">UBICACIÓ OFICINA</h2>
      {{-- Pots substituir per un mapa embedit o una foto --}}
      <img src="{{ asset('images/secretaria/nuevasInstalaciones.jpg') }}" alt="Ubicació de l'oficina" class="img-ubi">
      {{-- Exemple Google Maps embed (opcional) --}}
      {{-- <div class="map-embed">
        <iframe src="https://www.google.com/maps/embed?pb=..." loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div> --}}
      <p class="adreca">LOCALITZACIÓ: 📍 Carrer de l'estadi, s/n · Vila-seca</p>
    </div>
<div class="separator"></div>

    {{-- TELÈFONS (45%) --}}
    <div class="sec-tels card-box">
                  <h2 class="titol-noticies">TELÈFONS D’INTERÈS</h2>

      <ul class="llista-contacte">

    <li>📞 <strong>Oficina:</strong> <a href="tel:+34687324241">687 324 241</a></li>
    <li>🛡️ <strong>Club</strong> <a href="tel:+34900111222">900 111 222</a></li>
    <li>⚽ <strong>Coordinació</strong> <a href="tel:+34900111222">900 111 222</a></li>
    <li>🩺 <strong>Revisió mèdica:</strong> <a href="tel:+34123456789">123 456 789</a></li>
    <li>🏛️ <strong>Federació:</strong> <a href="tel:+34987654321">987 654 321</a></li>
    <li>🏥 <strong>Mútua esportiva:</strong> <a href="tel:+34900111222">900 111 222</a></li>
</ul>

      <div>
        ✉️ <strong>Email:</strong> <a href="mailto:secretaria@club.cat">secretaria@club.cat</a></li>
      </div>



    </div>
  </div>

</div>

@endsection
