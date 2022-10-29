<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Models\MsWilKab;
use Illuminate\Http\Request;

class MsWilKabController extends Controller
{
    public function select2()
    {
        $table = MsWilKab::query()
            ->where('is_primary', 1)
            ->orderBy('kdkab');

        return Select2::Generate($table, 'kdkab', 'nmkab');
    }

    public function index()
    {
        $data = MsWilKab::with(['kec', 'kec.desa'])
            ->where('is_primary', 1)
            ->orderBy('kdkab')->get();
        return response()->json($data);
    }

    public function store()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function destroy()
    {
        # code...
    }
}
