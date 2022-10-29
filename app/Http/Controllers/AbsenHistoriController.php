<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenHistoriController extends Controller
{
    public function index()
    {
        return view('absen-histori.index');
    }
}
