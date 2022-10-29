<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTable;
use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpotRequest;
use App\Http\Requests\UpdateSpotRequest;
use App\Models\AbsenSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenSpotController extends Controller
{
    public function select2()
    {
        $table = AbsenSpot::query()
            ->orderBy('spot');

        return Select2::Generate($table, 'spotid', 'spot');
    }

    public function dt()
    {
        $table = DB::table('v_absen_spot');
        return DataTable::generate($table);
    }

    public function index()
    {
        $data = AbsenSpot::query()
            ->orderBy('spot')->get();
        return response()->json($data);
    }

    public function show(AbsenSpot $spot)
    {
        return response()->json($spot);
    }

    public function store(StoreSpotRequest $request)
    {
        $spot = AbsenSpot::create([
            'spot' => $request->spot,
            'radius' => $request->radius,
            'alamat' => $request->alamat,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'catatan' => $request->catatan,
            'created_by' => $request->created_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $spot]);
    }

    public function update(AbsenSpot $spot, UpdateSpotRequest $request)
    {
        $spot->update([
            'spot' => $request->spot,
            'radius' => $request->radius,
            'alamat' => $request->alamat,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'catatan' => $request->catatan,
            'updated_by' => $request->updated_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $spot]);
    }

    public function destroy(AbsenSpot $spot)
    {
        $spot->delete();
        return response()->json(['message' => 'Data berhasil terhapus', 'data' => null]);
    }
}
