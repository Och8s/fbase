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

            <!-- Només modalitat (sense foto) -->
            @if ($equipsCategoria->first()->modalitat)
                <p class="modalitat">{{ ucfirst($equipsCategoria->first()->modalitat) }}</p>
            @endif

<!-- Botons de cada equip -->
<div class="botons-equips">
    @foreach ($equipsCategoria as $equip)
        <a href="{{ route('escola.equips.show', $equip->id) }}">
            <button class="btn-equip">
                <div class="subcategoria-text">
                    @if ($equip->categoria->modalitat_id == 3)
                        FEMENÍ
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
