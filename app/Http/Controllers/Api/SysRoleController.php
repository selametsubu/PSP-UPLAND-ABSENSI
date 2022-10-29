<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Models\SysRole;
use Illuminate\Http\Request;

class SysRoleController extends Controller
{

    public static function select2()
    {
        $q = request()->query('q');

        $query = SysRole::query();

        if ($query) {
            $query->orWhere('rolename', 'like', '%' . $q . '%');
        }
        $results = $query->get()
            ->map(function ($row) {
                return [
                    'id' => $row->roleid,
                    'text' => $row->rolename,
                    'kab' => $row->kab,
                    'kec' => $row->kec,
                    'desa' => $row->desa,
                ];
            })
            ->toArray();

        $data = [
            'results' => $results,
            'pagination' => [
                'more' => false
            ]
        ];
        return response()->json($data);
    }

    public function index()
    {
        return response()->json(SysRole::all());
    }

    public function show(SysRole $role)
    {
        return response()->json($role);
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
