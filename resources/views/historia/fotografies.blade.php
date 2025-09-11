@extends('layouts.public')

@section('title', 'Fotos Històriques')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/historia/fotosHist.css') }}">
@endsection

@section('content')
<div class="fotosh">
  <h2 class="fotosh__title">Fotografies històriques</h2>

  <div class="carousel" aria-label="Carrusel de fotografies">
    <button class="carousel__btn prev" aria-label="Anterior" data-dir="-1">‹</button>

    <div class="carousel__viewport" tabindex="0">
      @forelse($fotos as $f)
        @php
          // Normaliza la URL de la imagen según lo que guardes en BD
          $raw = trim($f->foto ?? '');

          if ($raw === '') {
              $img = null;
          } elseif (\Illuminate\Support\Str::startsWith($raw, ['http://','https://'])) {
              $img = $raw;
          } elseif (\Illuminate\Support\Str::startsWith($raw, ['public/'])) {
              $img = asset(\Illuminate\Support\Str::after($raw, 'public/'));
          } elseif (\Illuminate\Support\Str::startsWith($raw, ['images/'])) {
              $img = asset($raw);
          } else {
              // si solo guardas el nombre de archivo
              $img = asset('images/historia/fotos_antigues/' . ltrim($raw, '/'));
          }

          // Comprueba existencia local (para mostrar placeholder si no existe)
          $exists = true;
          if ($img && !\Illuminate\Support\Str::startsWith($img, ['http://','https://'])) {
              $localPath = public_path(parse_url($img, PHP_URL_PATH));
              $exists = file_exists($localPath);
          }

          $dataText = $f->data ? \Carbon\Carbon::parse($f->data)->format('d/m/Y') : '—';
        @endphp

        <figure class="carousel__slide js-foto"
                tabindex="0"
                data-titol="{{ e($f->titol) }}"
                data-facilitador="{{ e($f->facilitador ?? '') }}"
                data-data="{{ e($dataText) }}"
                data-lloc="{{ e($f->lloc ?? '') }}"
                data-descripcio="{{ e($f->descripcio ?? '') }}"
                data-foto="{{ $img ?? '' }}">
          @if($img && $exists)
            <img src="{{ $img }}" alt="{{ $f->titol }}" loading="lazy">
          @else
            <div style="width:100%;height:360px;display:grid;place-items:center;background:#f1f5f9;color:#64748b">
              <small>No s’ha trobat la imatge: <code>{{ $f->foto }}</code></small>
            </div>
          @endif

          <figcaption class="carousel__caption">
            <span class="carousel__caption__titol">{{ $f->titol }}</span>
            @if($f->lloc || $f->data)
              <span class="carousel__caption__meta">
                {{ $f->lloc ? $f->lloc : '' }}{{ ($f->lloc && $f->data) ? ' · ' : '' }}{{ $dataText }}
              </span>
            @endif
          </figcaption>
        </figure>
      @empty
        <p>No hi ha fotografies disponibles.</p>
      @endforelse
    </div>

    <button class="carousel__btn next" aria-label="Següent" data-dir="1">›</button>
  </div>

  <div class="carousel__dots" aria-label="Paginació"></div>
</div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/sweetAlertFotosAntigues.js') }}"></script>
@endsection
