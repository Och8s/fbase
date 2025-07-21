<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscolaController extends Controller
{
    public function index()
    {
        return view('escola.index');
    }

    public function formacio()
    {
        return view('escola.formacio');
    }

    public function equips()
    {
        return view('escola.equips');
    }

    public function estil()
    {
        return view('escola.estil');
    }

    public function metodologia()
    {
        return view('escola.metodologia');
    }

    public function accesEntrenador()
    {
        return view('escola.accesEntrenador');
    }

    public function accesCoordinador()
    {
        return view('escola.accesCoordinador');
    }
}
