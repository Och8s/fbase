@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/escola/equips.css') }}">
@endsection

@section('content')
<h2 class="titol-noticies">EQUIPS DE L'ESCOLA</h2>

@php
    // Agrupem per categoria i preparem array amb {nom, equips, count}
    $cats = $equips->groupBy('categoria.nom')->map(function ($equipsCategoria, $categoriaNom) {
        return [
            'nom' => $categoriaNom,
            'equips' => $equipsCategoria,
            'count' => $equipsCategoria->count(),
        ];
    })->values();

    // Helper per agrupar per subcategoria però separant FEMENÍ com a grup propi
    $groupBySubOrFemeni = function($collection) {
        $grups = $collection->groupBy(function($equip) {
            // Si és FEMENÍ (modalitat id == 3), el posem en un grup propi
            if ($equip->modalitat && $equip->modalitat->id == 3) {
                return '__FEMENI__';
            }
            // Si té subcategoria, la fem servir; sinó, un grup genèric
            return $equip->subcategoria ? $equip->subcategoria->nom : '__SENSE_SUB__';
        });

        // Ordenem claus i movem FEMENÍ al final
        $grups = $grups->sortKeys();
        if ($grups->has('__FEMENI__')) {
            $fem = $grups->pull('__FEMENI__');
            $grups = $grups->put('__FEMENI__', $fem);
        }
        return $grups;
    };
@endphp

<div class="container-equips">
    @for ($i = 0; $i < $cats->count(); $i++)
        @php
            $curr = $cats[$i];
            $next = $cats[$i + 1] ?? null;
            // Només emparellem si existeix la següent i ambdues tenen ≤4 equips
            $canPair = $next && $curr['count'] <= 4 && $next['count'] <= 4;

            $grupsSubCurr = $groupBySubOrFemeni($curr['equips']);
        @endphp

        <div class="fila-categories {{ $canPair ? '' : 'single' }}">
            {{-- Columna esquerra --}}
            <div class="categoria-bloc">
                <h3 class="titol-categoria">{{ strtoupper($curr['nom']) }}</h3>

                <div class="botons-equips">
                    @foreach ($grupsSubCurr as $clau => $equipsSub)
                        <div class="grup-subcategoria">
                            @foreach ($equipsSub as $equip)
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
                                        <div class="equip-nom">{{ strtoupper($equip->nom) }}</div>
                                    </button>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Columna dreta si es pot emparellar --}}
            @if ($canPair)
                @php
                    $grupsSubNext = $groupBySubOrFemeni($next['equips']);
                @endphp

                <div class="categoria-bloc">
                    <h3 class="titol-categoria">{{ strtoupper($next['nom']) }}</h3>

                    <div class="botons-equips">
                        @foreach ($grupsSubNext as $clau => $equipsSub)
                            <div class="grup-subcategoria">
                                @foreach ($equipsSub as $equip)
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
                                            <div class="equip-nom">{{ strtoupper($equip->nom) }}</div>
                                        </button>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                @php $i++; @endphp
            @endif
        </div>
    @endfor
</div>
@endsection
