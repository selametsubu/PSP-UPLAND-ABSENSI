<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;

class Select2
{
    public static function Generate($table, $colId, $colText){
        $q = request()->query('q');

        $query = DB::table($table);

        if($query){
            $query->orWhere($colText, 'like', '%' . $q . '%');
        }
        $query = $query->get();

        $results = array();
        foreach($query as $item){
            array_push($results, ['id' => $item->$colId, 'text' => trim($item->$colText)]);
        }

        $data = [
            'results' => $results,
            'pagination' => [
                'more' => false
            ]
        ];
        return response()->json($data);
    }
}
