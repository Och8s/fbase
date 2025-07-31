@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/twelveBlocsPatrocinadors.css') }}">
@endsection

@section('content')

<div class="contenidor-patrocinadors">
    @foreach ($patrocinadors as $patro)
        <div class="Apartat">
            <div class="MedioA hover-patro">
                <a href="{{ route('patrocinadors.mostra', $patro->id) }}">
                    <button>{{ $patro->nom }}</button>
                </a>
                <img src="{{ asset('images/patrocinadors/' . $patro->logo) }}" alt="{{ $patro->nom }}">

                @if ($patro->nom === 'M. LINARES')
                    <div class="missatge-hover">Patrocinador oficial del primer equip</div>
                @elseif ($patro->nom === 'MASQUEFINA')
                    <div class="missatge-hover">Patrocinador oficial del segon equip</div>
                @endif
            </div>

        </div>
    @endforeach
</div>




@endsection
