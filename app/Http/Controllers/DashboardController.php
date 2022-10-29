<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);

        $tanggal = $date->format('l, j F Y');
        return view('dashboard', compact('tanggal'));
    }
}
