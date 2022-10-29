<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbsenHadirRequest;
use App\Models\AbsenHadir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

class AbsenHadirController extends Controller
{
    public function dt()
    {
        $table = DB::table('v_absen_hadir');

        $user = User::findOrFail(request('userid'));
        if ($user->role->rolename != 'ADMIN') {
            $table = $table->where('userid', request('userid'));
        }

        return DataTable::generate($table);
    }

    public function index()
    {
    }

    public function store(StoreAbsenHadirRequest $request)
    {
        $file = $request->file('swafoto');

        $ImageUpload = Image::make($file);
        $originalPath = 'storage/user/absen/';
        $swafoto_ori = $ImageUpload->save($originalPath . time() . $file->getClientOriginalName());
        $swafoto_ori = $swafoto_ori->basename;
        $ImageUpload->resize(250, 250);
        $swafoto_thumb = $ImageUpload->save($originalPath . 'thumb_' . time() . $file->getClientOriginalName());
        $swafoto_thumb = $swafoto_thumb->basename;
        $absenHadir = AbsenHadir::create([
            'userid' => $request->userid,
            'tgl' => Carbon::make($request->tgl),
            'waktu' => $request->waktu,
            'waktu_bagian' => $request->waktu_bagian,
            // 'is_absen_datang' => $request->is_absen_datang,
            // 'is_absen_pulang' => $request->is_absen_pulang,
            'status_absen' => $request->status_absen,
            'status_spot' => $request->status_spot,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'lokasi' => $request->lokasi,
            'prov' => $request->prov,
            'kab' => $request->kab,
            'kec' => $request->kec,
            'desa' => $request->desa,
            'catatan' => $request->catatan,
            'swafoto_thumb' => 'user/absen/'. $swafoto_thumb,
            'swafoto_ori' => 'user/absen/'. $swafoto_ori,
            'created_at' => $request->created_at,
            'created_by' => $request->created_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $absenHadir]);
    }

    public function show(AbsenHadir $absenHadir)
    {
        $absenHadir = $absenHadir->load('user');
        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $absenHadir]);
    }

    public function destroy(AbsenHadir $absenHadir)
    {
        $absenHadir->delete();
        return response()->json(['message' => 'Data berhasil terhapus', 'data' => null]);
    }

    public function checkAlreadyAbsen()
    {
        $data = AbsenHadir::query()
            ->whereDate('tgl', Carbon::now()->toDate())
            ->where('status_absen', request('status_absen'))
            ->where('userid', request('userid'))
            ->firstOrFail();
        return response()->json($data);
    }
}
