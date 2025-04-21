<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equip;

class EquipsController extends Controller
{
    /**
     * Retorna tots els equips.
     */
    public function index()
    {
        return response()->json(Equip::all());
    }

    /**
     * Retorna les dades d’un equip concret.
     */
    public function show($id)
    {
        $equip = Equip::findOrFail($id);
        return response()->json($equip);
    }

    /**
     * Retorna els jugadors associats a un equip concret.
     */
    public function jugadors($id)
    {
        $equip = Equip::with('jugadors')->findOrFail($id);
        return response()->json($equip->jugadors);
    }
      /**
     * Retorna els partits associats a un equip concret.
     */
    // app/Http/Controllers/Api/EquipsController.php
        public function partits($id)
        {
            $equip = Equip::with('partits')->findOrFail($id);
            return response()->json($equip->partits);
        }

}
