<?php

namespace App\Http\Controllers;

use App\Exports\LaporanRekapKehadiranExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  Excel;

class LaporanRekapKehadiranController extends Controller
{
    public function index()
    {

        return view('laporan.rekap-kehadiran.index');
    }

    public function export()
    {
        ob_end_clean(); // clean first
        return Excel::download(new LaporanRekapKehadiranExport(
            auth()->id(),
            request('p_date_from'),
            request('p_date_to'),
            request('p_userid'),
            request('p_user_name'),
        ), 'LaporanRekapKehadiran.xlsx');
    }
}
