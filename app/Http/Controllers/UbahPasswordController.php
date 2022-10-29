<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UbahPasswordController extends Controller
{
    public function index()
    {
        return view('ubah-password.index');
    }
}
