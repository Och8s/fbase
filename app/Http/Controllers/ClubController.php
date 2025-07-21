<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ClubController extends Controller
{
    public function index()
    {
        return view('club.index'); // Aquesta és la vista que ja tens creada
    }

    // Pots afegir més mètodes com aquests quan els necessitis:
    public function noticies() { return view('club.noticies'); }
    public function quiSom() { return view('club.qui'); }
    public function objectius() { return view('club.objectius'); }
    public function events() { return view('club.events'); }
    public function soci() { return view('club.soci'); }
    public function accesSoci() { return view('club.accesSoci'); }
}
