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
        $p_userid = request('p_userid');
        $p_date_from = request('p_date_from');
        $p_date_to = request('p_date_to');
        $p_global = request('p_global');
        return view('absen-histori.absen-manual', compact('p_userid', 'p_date_from', 'p_date_to', 'p_global'));
    }

    public function absenManualEdit($userid, $tgl)
    {
        $user = \App\Models\User::findOrFail(request('userid'));
        $data = \DB::select('CALL pr_absen_manual(?, ?, ?)', [$userid, $tgl, $tgl])[0];
        $p_date_from = request('p_date_from');
        $p_date_to = request('p_date_to');
        $p_global = request('p_global');

        if ($data->datang_status_spot == "Sesuai Spot") {
            $data->datang_status_spot = 1;
        }else if ($data->datang_status_spot == "Diluar Spot") {
            $data->datang_status_spot = 2;
        }else{
            $data->datang_status_spot = 0;
        }

        if ($data->pulang_status_spot == "Sesuai Spot") {
            $data->pulang_status_spot = 1;
        }else if ($data->pulang_status_spot == "Diluar Spot") {
            $data->pulang_status_spot = 2;
        }else{
            $data->pulang_status_spot = 0;
        }
        // return $data;
        return view('absen-histori.absen-manual-edit', compact('data', 'user', 'tgl', 'p_date_from', 'p_date_to', 'p_global'));
    }
}
