<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenHistoriController extends Controller
{
    public function index()
    {
        return view('absen-histori.index');
    }

    public function absenManual()
    {
        return view('absen-histori.absen-manual');
    }

    public function absenManualEdit($userid, $tgl)
    {
        $user = \App\Models\User::findOrFail(request('userid'));
        $data = \DB::select('CALL pr_absen_manual(?, ?, ?)', [$userid, $tgl, $tgl])[0];
        return view('absen-histori.absen-manual-edit', compact('data', 'user', 'tgl'));
    }
}
