<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IzinCutiController extends Controller
{
    public function index()
    {
        return view('izin.index');
    }

    public function create()
    {
        return view('izin.create');
    }

    public function edit($id)
    {
        return view('izin.edit', compact('id'));
    }
}
