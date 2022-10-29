<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SysZonaWaktu;
use Illuminate\Http\Request;

class SysZonaWaktuController extends Controller
{
    public function index()
    {
        return response()->json(SysZonaWaktu::all());
    }
}
