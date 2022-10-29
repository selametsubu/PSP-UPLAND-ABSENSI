<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilSayaController extends Controller
{
    public function index()
    {
        $id = auth()->id();
        return view('profil.index', compact('id'));
    }
}
