@extends('layouts.public')

@section('title', 'Acció | ' . $event->titol)

@section('styles')

  <link rel="stylesheet" href="{{ asset('css/club/esdeveniment.css') }}">
@endsection

@section('content')
<main class="esdeveniment-senzill">
  <h1 class="ev-title">{{ $event->titol }}</h1>


  <div class="ev-layout">
    {{-- Izquierda: foto + dades --}}
    <aside class="ev-left">
      @if($event->foto)
        <div class="ev-image">
          <img src="{{ asset($event->foto) }}" alt="{{ $event->titol }}">
        </div>
      @endif

      @php
        \Carbon\Carbon::setLocale('ca');
        $ini = \Carbon\Carbon::parse($event->data_inici);
        $fin = \Carbon\Carbon::parse($event->data_final);
        $mateixDia = $ini->isSameDay($fin);
        $dinarTxt = $event->dinar ? 'Amb dinar' : 'Sense dinar';
        $preuTxt  = is_null($event->preu) ? '—' : number_format($event->preu, 2, ',', '.') . ' €';
      @endphp

      <section class="ev-dades">
        <h2 class="ev-dades-title">Dades de l’esdeveniment</h2>
        @if($mateixDia)
          <p>📅 <strong>Dia:</strong> {{ $ini->translatedFormat('d F Y') }}</p>
        @else
          <p>📅 <strong>Dies:</strong><br>des de {{ $ini->translatedFormat('d F Y') }}<br>fins al {{ $fin->translatedFormat('d F Y') }}</p>
        @endif
        <p>🕘 <strong>Horari:</strong> {{ $event->horari ?: '—' }}</p>
        <p>🍽️ <strong>Dinar:</strong> {{ $dinarTxt }}</p>
        <p>💶 <strong>Preu:</strong> {{ $preuTxt }}</p>
      </section>
    </aside>

    {{-- Derecha: partial del formulario según action_type --}}
    <article class="ev-right">

        {{-- titol segons action:type --}}
@switch($event->action_type)
    @case('inscripcio_campus')
        <h2 class="ev-detallat-title">Formulari</h2>
        @break
     @case('inscripcio_tecnificacio')
        <h2 class="ev-detallat-title">Formulari</h2>
        @break

    @case('ticket_menjar_presentacio')
        <h2 class="ev-detallat-title">Compra ticket menjar</h2>
        @break

    @case('ticket_menjar_soci')
        <h2 class="ev-detallat-title">Compra ticket menjar</h2>
        @break

    @case('documentacio')
        <h2 class="ev-detallat-title">Enviar Documentació</h2>
        @break

    @case('entrades_gratuites')
        <h2 class="ev-detallat-title">Reservar Entrada</h2>
        @break

    @default
        <h2 class="ev-detallat-title">Acció</h2>
@endswitch

      @includeIf('club.events.actions.' . $event->action_type, ['event' => $event])

@unless (View::exists('club.events.actions.' . $event->action_type))
  <p>Acció no disponible per a aquest esdeveniment.</p>
@endunless


      {{-- Mensaje OK --}}
      @if (session('status'))
        <div class="alert-ok" style="margin-top:1rem;padding:.6rem 1rem;border-radius:8px;background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0">
          {{ session('status') }}
        </div>
      @endif
    </article>
  </div>

  <div class="ev-actions" style="margin-top:1rem">
    <a class="btn-veure btn-back" href="{{ route('club.events') }}">TORNAR A ESDEVENIMENTS</a>
  </div>
</main>
@endsection
