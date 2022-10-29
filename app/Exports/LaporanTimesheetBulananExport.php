<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanTimesheetBulananExport implements FromView
{
    public $userid, $p_tahun_bulan, $p_userid, $p_user_name, $p_bulan_name;

    public function __construct($userid, $p_tahun_bulan, $p_userid, $p_user_name, $p_bulan_name)
    {
        $this->userid = $userid;
        $this->p_tahun_bulan = $p_tahun_bulan;
        $this->p_userid = $p_userid;
        $this->p_user_name = is_array($p_user_name) ? implode(',', $p_user_name) : ($p_user_name ?? 'Semua');
        $this->p_bulan_name = $p_bulan_name;
    }

    public function view(): View
    {
        $url = env('API_URL') . '/laporan/timesheet-bulanan';
        $response = Http::get(
            $url,
            [
                'userid' => $this->userid,
                'p_tahun_bulan' => $this->p_tahun_bulan,
                'p_userid' => $this->p_userid,
            ]
        );

        $data = json_decode($response->body());
        $eofMonth = Carbon::now()->endOfMonth()->day;
        $ref = config('ref.absen_status_bgcolor_hexa');
        return view('laporan.timesheet-bulanan.export', [
            'data' => $data,
            'p_tahun_bulan' => $this->p_tahun_bulan,
            'p_user_name' => $this->p_user_name,
            'p_bulan_name' => $this->p_bulan_name,
            'eofMonth' => $eofMonth,
            'ref' => $ref,
        ]);
    }
}
