<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIzinRequest;
use App\Http\Requests\UpdateIzinRequest;
use App\Models\AbsenIzin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenIzinController extends Controller
{
    public function dt()
    {
        $user = User::findOrFail(request('userid'));

        $table = DB::table('v_absen_izin');

        if ($user->role->rolename != 'ADMIN') {
            $table = $table->where('userid', request('userid'));
        }

        if (request('tgl_dari') && request('tgl_sampai')) {
            $tgl_dari = Carbon::make(request('tgl_dari'));
            $tgl_sampai = Carbon::make(request('tgl_sampai'));
            $table = $table->whereDate('tgl_dari', '>=', $tgl_dari);
            $table = $table->whereDate('tgl_sampai', '<=', $tgl_sampai);
        }

        return DataTable::generate($table);
    }

    public function checkIzinCuti()
    {
        $data = AbsenIzin::whereDate('tgl_dari', '<=', Carbon::now()->toDate())->whereDate('tgl_sampai', '>=', Carbon::now()->toDate())
            ->where('userid', request('userid'))
            ->firstOrFail();
        return response()->json($data);
    }

    public function index()
    {
        $data = AbsenIzin::query()
            ->orderBy('tgl_dari')->get();
        return response()->json($data);
    }

    public function show(AbsenIzin $izin)
    {
        return response()->json($izin);
    }

    public function store(StoreIzinRequest $request)
    {
        $spot = AbsenIzin::create([
            'userid' => $request->userid,
            'jenis_izin' => $request->jenis_izin,
            'aktifitas' => $request->aktifitas,
            'tgl_dari' => $request->tgl_dari,
            'tgl_sampai' => $request->tgl_sampai,
            'dok_ori' => $request->dok_ori,
            'dok_saved' => $request->dok_saved,
            'created_by' => $request->created_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $spot]);
    }

    public function update(AbsenIzin $izin, UpdateIzinRequest $request)
    {
        $izin->update([
            'userid' => $request->userid,
            'jenis_izin' => $request->jenis_izin,
            'aktifitas' => $request->aktifitas,
            'tgl_dari' => $request->tgl_dari,
            'tgl_sampai' => $request->tgl_sampai,
            'dok_ori' => $request->dok_ori,
            'dok_saved' => $request->dok_saved,
            'updated_by' => $request->updated_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $izin]);
    }

    public function destroy(AbsenIzin $izin)
    {
        $izin->delete();
        return response()->json(['message' => 'Data berhasil terhapus', 'data' => null]);
    }

    public function destroyDok(AbsenIzin $izin, Request $request)
    {
        $izin->update(
            [
                'dok_ori' => null,
                'dok_saved' => null,
                'updated_by' => $request->updated_by,
            ]
        );
        return response()->json(['message' => 'Dokumen berhasil terhapus', 'data' => $izin]);
    }

    public function uploadDokumen()
    {
        request()->validate([
            'file' => 'required|mimes:png,jpg,pdf'
        ]);

        $dok_ori = request()->file('file')->getClientOriginalName();
        $dok_saved = request()->file('file')->store('kegiatan/dokumen', 'public');

        $data = [
            'dok_ori' => $dok_ori,
            'dok_saved' => $dok_saved,
        ];

        return response()->json($data);
    }

    public function refJenisIzin()
    {
        $data = DB::table('v_absen_ref_jenis_izin')->get();
        return response()->json($data);
    }
}
