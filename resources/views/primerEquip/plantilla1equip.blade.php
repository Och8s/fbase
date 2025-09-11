@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/primerEquip/plantilla1equip.css') }}">
@endsection

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="plantilla1equip container">
    <h2 class="titol-plantilla">PLANTILLA PRIMER EQUIP 2024/25</h2>

    <div class="plantilla-grid">
        @forelse($jugadors as $jugador)
            @php
                // Calcula el src de la foto: primer provem storage/, sinó una imatge per defecte
                $src = $jugador->foto
                    ? (Str::startsWith($jugador->foto, ['http://','https://'])
                        ? $jugador->foto
                        : (Str::startsWith($jugador->foto, ['images/', 'img/'])
                            ? asset($jugador->foto)
                            : asset('storage/'.$jugador->foto)))
                    : asset('imagesGeneral/user_silhouette.png');
            @endphp

            <div class="player-card">
                <div class="photo-wrapper">
                    <img src="{{ $src }}" alt="Foto de {{ $jugador->nom }} {{ $jugador->cognoms }}">
                </div>

                <p class="player-name">
                    @if(!empty($jugador->dorsal))
                        <span class="dorsal">#{{ $jugador->dorsal }}</span>
                    @endif
                    {{ $jugador->nom }} {{ $jugador->cognoms }}
                </p>

                <button
                    class="btn-mes-info"
                    type="button"
                    data-id="{{ $jugador->id }}"
                    data-name="{{ $jugador->nom }} {{ $jugador->cognoms }}"
                >
                    MÉS INFO
                </button>
            </div>
        @empty
            <p class="no-players">Encara no hi ha jugadors registrats per al Primer Equip.</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.btn-mes-info').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const nom = this.dataset.name || 'aquest jugador';
      alert('Properament: fitxa de ' + nom);
      // Més endavant: substituirem per SweetAlert i/o obrirem una vista detallada.
    });
  });
});
</script>
@endsection
