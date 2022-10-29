<?php

namespace App\Http\Controllers;

use App\Exports\LaporanTimesheetBulananExport;
use Illuminate\Http\Request;
use  Excel;

class LaporanTimesheetBulananController extends Controller
{
    public function index()
    {
        return view('laporan.timesheet-bulanan.index');
    }

    public function export()
    {
        return Excel::download(new LaporanTimesheetBulananExport(
            auth()->id(),
            request('p_tahun_bulan'),
            request('p_userid'),
            request('p_user_name'),
            request('p_bulan_name'),
        ), 'LaporanTimesheetBulanan.xlsx');
    }
}
