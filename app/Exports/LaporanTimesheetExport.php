<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanTimesheetExport implements FromView
{
    public $userid, $p_date_from, $p_date_to, $p_userid, $p_user_name;

    public function __construct($userid, $p_date_from, $p_date_to, $p_userid, $p_user_name)
    {
        $this->userid = $userid;
        $this->p_date_from = $p_date_from;
        $this->p_date_to = $p_date_to;
        $this->p_userid = $p_userid;
        $this->p_user_name = is_array($p_user_name) ? implode(',', $p_user_name) : ($p_user_name ?? 'Semua');
    }

    public function view(): View
    {
        $url = env('API_URL') . '/laporan/timesheet';
        $response = Http::get(
            $url,
            [
                'userid' => $this->userid,
                'p_date_from' => $this->p_date_from,
                'p_date_to' => $this->p_date_to,
                'p_userid' => $this->p_userid,
            ]
        );

        $data = json_decode($response->body());
        return view('laporan.timesheet.export', [
            'data' => $data,
            'p_date_from' => $this->p_date_from,
            'p_date_to' => $this->p_date_to,
            'p_user_name' => $this->p_user_name,
        ]);
    }
}
