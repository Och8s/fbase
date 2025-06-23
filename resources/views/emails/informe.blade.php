@component('mail::message')
# Informe de {{ $jugador->nom }} {{ $jugador->cognoms }}

<div style="text-align: right; font-size: 0.8rem; color: #555;">
    Data: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
</div>

**Equip:** {{ $jugador->equip->nom }} | {{ $jugador->equip->categoria }}


---

## 🏃 Participació

- Partits jugats: {{ $estadistiques['partits_jugats'] }}
- Titularitats: {{ $estadistiques['titularitats'] }}
- Minuts jugats: {{ $estadistiques['minuts_jugats'] }}
- Minuts jugats per partit: {{ $estadistiques['minuts_jugatsXpartit'] ?? 'n/a' }}
- % de minuts disputats respecte al total de l'equip: {{ $estadistiques['percentatge_minuts'] ?? 'n/a' }}%

---

## ⚽ Gols

- Gols marcats: {{ $estadistiques['gols'] }}
- Fa un gol cada {{ $estadistiques['minuts_per_gol'] ?? 'n/a' }} minuts
- Gols de l’equip amb el jugador al camp: {{ $estadistiques['gols_favor_amb'] ?? 'n/a' }}
- Gols rebuts amb el jugador al camp: {{ $estadistiques['gols_contra_amb'] ?? 'n/a' }}
- Diferència de gols amb ell al camp: {{ $estadistiques['diferencia_gols'] ?? 'n/a' }}

---

## 📊 Comparativa Gols

- Mitjana de gols a favor amb el jugador al camp: {{ $estadistiques['mitjana_gols_favor_amb'] ?? 'n/a' }}
- Mitjana de gols en contra amb el jugador al camp: {{ $estadistiques['mitjana_gols_contra_amb'] ?? 'n/a' }}
- Mitjana de gols a favor de l’equip (global): {{ $estadistiques['mitjana_gols_favor_equip'] ?? 'n/a' }}
- Mitjana de gols en contra de l’equip (global): {{ $estadistiques['mitjana_gols_contra_equip'] ?? 'n/a' }}

---

## 🏆 Punts

- Mitjana de punts quan juga el partit: {{ $estadistiques['mitjana_jjp'] }}
- Mitjana de punts quan està al camp: {{ $estadistiques['mitjana_jec'] }}
- Mitjana de punts quan és titular: {{ $estadistiques['mitjana_jjp_titular'] ?? 'n/a' }}
- Mitjana general de punts de l’equip: {{ $estadistiques['mitjana_total_equip'] ?? 'n/a' }}

---
---

## 🔍 Valoració

{{ $estadistiques['valoracio'] ?? 'No disponible' }}


Gràcies per formar part del Club Vilaseca!

@endcomponent
