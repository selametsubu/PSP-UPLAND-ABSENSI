<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenPulangController extends Controller
{
    public function index()
    {
        return view('absen-pulang.index');
    }

    public function success()
    {
        return view('absen-pulang.success');
    }
    public function error()
    {
        return view('absen-pulang.error');
    }
}
