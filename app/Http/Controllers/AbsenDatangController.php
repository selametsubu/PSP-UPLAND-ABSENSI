<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsenHadirRequest;
use Illuminate\Http\Request;

class AbsenDatangController extends Controller
{
    public function index()
    {
        return view('absen-datang.index');
    }

    public function success()
    {
        return view('absen-datang.success');
    }

    public function error()
    {
        return view('absen-datang.error');
    }

}
