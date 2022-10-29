<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSysGlobalVarRequest;
use App\Http\Requests\UpdateSysGlobalVarRequest;
use App\Models\SysGlobalVar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SysGlobalVarApiController extends Controller
{

    public function dt()
    {
        $table = DB::table('absen_sys_globalvar');
        return DataTable::generate($table);
    }

    public function index()
    {
        $data = SysGlobalVar::all();
        return response()->json($data);
    }

    public function store(StoreSysGlobalVarRequest $request)
    {
        $globalvar = SysGlobalVar::create($request->validated());

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $globalvar]);
    }

    public function show(SysGlobalVar $globalvar)
    {
        return response()->json($globalvar);
    }

    public function update(UpdateSysGlobalVarRequest $request, SysGlobalVar $globalvar)
    {
        $globalvar->update($request->validated());

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $globalvar]);
    }

    public function destroy(SysGlobalVar $globalvar)
    {
        $globalvar->delete();
        return response()->json(['message' => 'Data berhasil terhapus', 'data' => null]);
    }
}
