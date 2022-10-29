<?php

namespace App\Http\Controllers;

use App\Exports\LaporanTimesheetExport;
use Illuminate\Http\Request;
use  Excel;

class LaporanTimesheetController extends Controller
{
    public function index()
    {
        return view('laporan.timesheet.index');
    }

    public function export()
    {
        ob_end_clean(); // clean first
        return Excel::download(new LaporanTimesheetExport(
            auth()->id(),
            request('p_date_from'),
            request('p_date_to'),
            request('p_userid'),
            request('p_user_name'),
        ), 'LaporanTimesheet.xlsx');
    }
}
