@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/escola/equips.css') }}">
@endsection

@section('content')
<h2 class="titol-noticies">EQUIPS DE L'ESCOLA</h2>

<div class="container-equips">
    @foreach ($equips->groupBy('categoria.nom') as $categoriaNom => $equipsCategoria)
        <div class="categoria-bloc">
            <!-- Títol gran de la categoria -->
            <h3 class="titol-categoria">{{ strtoupper($categoriaNom) }}</h3>


<!-- Botons de cada equip -->
<div class="botons-equips">
    @foreach ($equipsCategoria as $equip)
        <a href="{{ route('escola.equips.show', $equip->id) }}">
            <button class="btn-equip {{ $equip->modalitat && $equip->modalitat->id == 3 ? 'femeni-btn' : '' }}">
                <div class="subcategoria-text">
                    @if ($equip->modalitat && $equip->modalitat->id == 3)
                        {{ strtoupper($equip->modalitat->nom) }}
                    @elseif ($equip->subcategoria)
                        {{ strtoupper($equip->subcategoria->nom) }}
                    @else
                        {{ strtoupper($equip->categoria->nom) }}
                    @endif
                </div>
                <div class="equip-nom">
                    {{ strtoupper($equip->nom) }}
                </div>
            </button>
        </a>
    @endforeach
</div>





        </div>
    @endforeach
</div>
@endsection
