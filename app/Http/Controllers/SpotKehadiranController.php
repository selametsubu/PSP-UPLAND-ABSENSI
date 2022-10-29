<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpotKehadiranController extends Controller
{
    public function index()
    {
        return view('pengaturan.spot.index');
    }

    public function create()
    {
        return view('pengaturan.spot.create');
    }

    public function edit($id)
    {
        return view('pengaturan.spot.edit', compact('id'));
    }
}
