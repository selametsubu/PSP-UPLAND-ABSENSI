<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanHariLiburController extends Controller
{
    public function index()
    {
        return view('pengaturan.hari-libur.index');
    }
}
