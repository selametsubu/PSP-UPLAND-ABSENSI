<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLiburRequest;
use App\Http\Requests\UpdateLiburRequest;
use App\Models\AbsenHariLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenHariLiburController extends Controller
{
    public function dt()
    {
        $table = DB::table('absen_harilibur');
        return DataTable::generate($table);
    }

    public function index()
    {
        $data = AbsenHariLibur::query()
            ->orderBy('tgl_dari')->get();
        return response()->json($data);
    }

    public function show(AbsenHariLibur $libur)
    {
        return response()->json($libur);
    }

    public function store(StoreLiburRequest $request)
    {
        $spot = AbsenHariLibur::create([
            'harilibur' => $request->harilibur,
            'tgl_dari' => $request->tgl_dari,
            'tgl_sampai' => $request->tgl_sampai,
            'catatan' => $request->catatan,
            'created_by' => $request->created_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $spot]);
    }

    public function update(AbsenHariLibur $libur, UpdateLiburRequest $request)
    {
        $libur->update([
            'harilibur' => $request->harilibur,
            'tgl_dari' => $request->tgl_dari,
            'tgl_sampai' => $request->tgl_sampai,
            'catatan' => $request->catatan,
            'updated_by' => $request->updated_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $libur]);
    }

    public function destroy(AbsenHariLibur $libur)
    {
        $libur->delete();
        return response()->json(['message' => 'Data berhasil terhapus', 'data' => null]);
    }
}
