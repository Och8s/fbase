{{-- resources/views/club/noticiaPlantilla.blade.php --}}
@extends('layouts.public')

@section('title', $noticia->titol . ' | Club')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/club/noticia.css') }}">
@endsection

@section('content')
<main class="noticia-senzilla">
  {{-- 1) Títol --}}
  <h1 class="ns-title">{{ $noticia->titol }}</h1>

  {{-- 2) Intro: només descripció opcional (sense foto) --}}
  @if(!empty($noticia->descripcio))
    <div class="ns-intro">
      <p class="ns-desc">{{ $noticia->descripcio }}</p>
    </div>
  @endif

  {{-- 3) Article amb foto a la dreta i meta sota la foto --}}
  <article class="ns-article">
    @if($noticia->foto)
      <aside class="ns-article-image">
        <img src="{{ asset($noticia->foto) }}" alt="{{ $noticia->titol }}">
        <div class="ns-photo-meta">
          <span class="ns-seccio">{{ str_replace('_', ' ', ucwords($noticia->seccio, '_')) }}</span>
          <span class="ns-dot">·</span>
          <time class="ns-date" datetime="{{ $noticia->data }}">
            {{ \Carbon\Carbon::parse($noticia->data)->translatedFormat('d F Y') }}
          </time>
        </div>
      </aside>
    @endif

    @if(!empty($noticia->article))
      {!! $noticia->article !!}
    @else
      @if(!empty($noticia->descripcio))
        <p>{{ $noticia->descripcio }}</p>
      @endif
    @endif
  </article>

  {{-- 4) Botó tornar --}}
 <div class="ns-actions">
  <a class="btn-veure btn-back" href="{{ route('club.noticies') }}">TORNAR A NOTÍCIES</a>
</div>

</main>
@endsection
