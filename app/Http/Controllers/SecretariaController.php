<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index()
    {
        return view('secretaria.index');
    }


    // app/Http/Controllers/SecretariaController.php
public function oficina()
{
    return view('secretaria.oficina');
}

    public function inscripcions()
    {
        return view('secretaria.inscripcions');
    }

// SecretariaController.php
public function merchandasing()
{
    return view('secretaria.vestuari'); // aquí llamas a vestuari.blade.php
}
    public function normativa()
    {
        return view('secretaria.normativa');
    }

    public function contacte()
    {
        return view('secretaria.contacte');
    }

    public function acces()
    {
        return view('secretaria.acces');
    }
}
