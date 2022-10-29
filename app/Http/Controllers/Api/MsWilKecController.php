<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Models\MsWilKec;
use Illuminate\Http\Request;

class MsWilKecController extends Controller
{
    public function select2()
    {
        $table = MsWilKec::query()
            ->orderBy('kdkec');

        if(request('kdkab')){
            $table = $table->where('kdkab', request('kdkab'));
        }

        return Select2::Generate($table, 'kdkec', 'nmkec');
    }

    public function index()
    {
        $data = MsWilKec::query()
            ->orderBy('kdkec')->get();
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
