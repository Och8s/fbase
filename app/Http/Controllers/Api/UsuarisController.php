<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarisController extends Controller
{
    /**
     * Retorna les dades de l’usuari autenticat.
     */
    public function showAuth(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Llista tots els usuaris (només per control intern o admin).
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Retorna un usuari concret pel seu ID.
     */
    public function show($id)
    {
        $usuari = User::findOrFail($id);
        return response()->json($usuari);
    }
}
