<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    public function index()
    {
        return view('historia.index');
    }

    public function ressenya()
    {
        return view('historia.ressenya');
    }

    public function cronologia()
    {
        return view('historia.cronologia');
    }

    public function fotografies()
    {
        return view('historia.fotografies');
    }

    public function envians()
    {
        return view('historia.envians');
    }
}
