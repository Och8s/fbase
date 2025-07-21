<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortersController extends Controller
{
    public function index()
    {
        return view('porters.index');
    }

    public function formacio()
    {
        return view('porters.formacio');
    }

    public function horari()
    {
        return view('porters.horari');
    }

    public function entrenadors()
    {
        return view('porters.entrenadors');
    }

    public function plans()
    {
        return view('porters.plans');
    }

    public function contacte()
    {
        return view('porters.contacte');
    }
}
