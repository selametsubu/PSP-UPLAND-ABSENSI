<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Models\MsWilDesa;
use Illuminate\Http\Request;

class MsWilDesaController extends Controller
{
    public function select2()
    {
        $table = MsWilDesa::query()
            ->orderBy('kddesa');

        if (request('kdkec')) {
            $table = $table->where('kdkec', request('kdkec'));
        }

        return Select2::Generate($table, 'kddesa', 'nmdesa');
    }

    public function index()
    {
        $data = MsWilDesa::query()
            ->orderBy('kddesa')->get();
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
