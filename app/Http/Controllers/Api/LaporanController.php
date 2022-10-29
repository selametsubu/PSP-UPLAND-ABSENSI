<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LaporanController extends Controller
{
    public function tahun()
    {
        $data = DB::table('v_absen_ref_tahun')
            ->select('sYear as tahun')
            ->orderBy('sYear')
            ->get();

        return response()->json($data);
    }

    public function rekapKehadiran()
    {
        $p_date_from = Carbon::make(request('p_date_from'));
        $p_date_to = Carbon::make(request('p_date_to'));

        $user = User::findOrFail(request('userid'));

        /*
            Jika ROLE PIU maka kembalikan data user yang ada pada KAB c PIU tersebut
        */
        if ($user->role->rolename == 'PIU') {


            if (!request('p_userid')) {
                $p_userid = User::query()
                    ->where('kdkab', $user->kdkab)
                    ->pluck('userid')
                    ->toArray();
                $p_userid = implode(',', $p_userid);
            }else{
                $p_userid = implode(',', request('p_userid'));
            }

            $data = DB::select('CALL pr_absen_rekap_kehadiran(?, ?, ?)', [$p_userid, $p_date_from, $p_date_to]);
            return response()->json($data);
        }

        /*
            Jika bukan ROLE ADMIN maka kembalikan data user tersebut
        */
        if ($user->role->rolename != 'ADMIN') {
            $data = DB::select('CALL pr_absen_rekap_kehadiran(?, ?, ?)', [request('userid'), $p_date_from, $p_date_to]);
            return response()->json($data);
        }

        /*
            Jika tidak maka semua user bisa dilihat
        */
        $p_userid = request('p_userid') ?? null;
        if ($p_userid) {
            $p_userid = implode(',', $p_userid);
        }
        $data = DB::select('CALL pr_absen_rekap_kehadiran(?, ?, ?)', [$p_userid, $p_date_from, $p_date_to]);
        return response()->json($data);
    }

    public function timesheetBulanan()
    {
        $user = User::findOrFail(request('userid'));

        /*
            Jika ROLE PIU maka kembalikan data user yang ada pada KAB c PIU tersebut
        */
        if ($user->role->rolename == 'PIU') {
            $p_userid = User::query()
                ->where('kdkab', $user->kdkab)
                ->pluck('userid')
                ->toArray();
            $p_userid = implode(',', $p_userid);
            $data = DB::select('CALL pr_absen_timesheet_bulanan(?, ?)', [$p_userid, request('p_tahun_bulan')]);
            return response()->json($data);
        }

        if ($user->role->rolename != 'ADMIN') {
            $data = DB::select('CALL pr_absen_timesheet_bulanan(?, ?)', [request('userid'), request('p_tahun_bulan')]);
            return response()->json($data);
        }

        $p_userid = request('p_userid') ?? null;
        if ($p_userid) {
            $p_userid = implode(',', $p_userid) ?? null;
        }

        $p_tahun_bulan = request('p_tahun_bulan');
        $data = DB::select('CALL pr_absen_timesheet_bulanan(?, ?)', [$p_userid, $p_tahun_bulan]);
        return response()->json($data);
    }

    public function timesheet()
    {
        $p_date_from = Carbon::make(request('p_date_from'));
        $p_date_to = Carbon::make(request('p_date_to'));

        $user = User::findOrFail(request('userid'));

        if ($user->role->rolename == 'PIU') {
            $data = DB::select('CALL pr_absen_timesheet(?, ?, ?)', [request('p_userid'), $p_date_from, $p_date_to]);
            return response()->json($data);
        }

        if ($user->role->rolename != 'ADMIN') {
            $data = DB::select('CALL pr_absen_timesheet(?, ?, ?)', [request('userid'), $p_date_from, $p_date_to]);
            return response()->json($data);
        }

        $p_userid = request('p_userid') ?? null;
        $data = DB::select('CALL pr_absen_timesheet(?, ?, ?)', [$p_userid, $p_date_from, $p_date_to]);
        return response()->json($data);
    }

    public function dashboardAll()
    {
        $data = DB::select('CALL `pr_absen_dash_all`(?)', [request('p_cat')]);
        return response()->json($data);
    }

    public function dashboardUser()
    {
        $data = DB::select('CALL `pr_absen_dash_user`(?)', [request('p_userid')]);
        $data = isset($data[0]) ? $data[0] : [];
        return response()->json($data);
    }
}
