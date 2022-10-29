<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanUmumController extends Controller
{
    public function index()
    {
        return view('pengaturan.umum.index');
    }
}
