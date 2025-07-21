<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatrocinadorsController extends Controller
{
    public function index()
    {
        return view('patrocinadors.index');
    }
}
