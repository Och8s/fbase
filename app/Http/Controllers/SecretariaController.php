<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index()
    {
        return view('secretaria.index');
    }

    public function oficina()
    {
        return view('secretaria.oficina');
    }

    public function inscripcions()
    {
        return view('secretaria.inscripcions');
    }

    public function merchandasing()
    {
        return view('secretaria.merchandasing');
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
