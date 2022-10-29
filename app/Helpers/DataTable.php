<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;

class DataTable
{
    public static function generate($tableName)
    {
        $columns = request()->input('columns');
        $order = request()->input('order');
        $length = request()->input('length') ?? 10;
        $start = request()->input('start');
        $searchAll = request()['search']['value'];

        $query = DB::table($tableName);
        $queryFIltered = DB::table($tableName);
        $queryTotal = DB::table($tableName)->count();

        // check default options
        if (!empty($options)) {
            // check where options
            if (!empty($options['where'])) {
                foreach ($options['where'] as $row) {
                    $query->where($row[0], $row[1],  $row[2]);
                }
            }
        }

        // limit
        if ($length != -1) {
            $query->offset($start)->limit($length);
        }

        // order by
        if (!empty($order)) {
            foreach ($order as $k => $v) {
                $orderColumn = $order[$k]['column'];
                $orderDir = $order[$k]['dir'];
                $columnName = $columns[$orderColumn]['data'];
                $query->orderBy($columnName, $orderDir);
            }
        }

        // get global search

        // $whereFilter = [];
        // if(!empty($searchAll)){
        //     foreach ($columns as $i => $v) {
        //         $arr = [$columns[$i]['data'], 'like',  '%' . trim($searchAll) . '%'];
        //         array_push($whereFilter, $arr);
        //     }
        // }



        // get individual search
        // $whereFilter = [];
        if (!empty($columns)) {
            $query->Where(function($query) use($columns, $queryFIltered) {
                foreach ($columns as $i => $v) {
                    if ($columns[$i]['searchable'] !== false && !empty($columns[$i]['search']['value'])) {
                        $query->where($columns[$i]['data'], 'like',  '%' . trim($columns[$i]['search']['value']) . '%');
                        $queryFIltered->where($columns[$i]['data'], 'like',  '%' . trim($columns[$i]['search']['value']) . '%');
                    }
                }

                //echo($query->toSql());
            });
        }

        if (!empty($searchAll)) {

            $query->Where(function($query) use($columns, $searchAll, $queryFIltered) {
                foreach ($columns as $i => $v) {
                    $query->orWhere($columns[$i]['data'], 'like',  '%' . trim($searchAll) . '%');
                    $queryFIltered->orWhere($columns[$i]['data'], 'like',  '%' . trim($searchAll) . '%');
                }
            });


            //echo($query->toSql());
        }

        $data = $query->get();

        //$total = DB::table($tableName);
        // if (!empty($options['where'])) {
        //     foreach ($options['where'] as $row) {
        //         $total->where($row[0], $row[1],  $row[2]);
        //     }
        // }

        // if (!empty($whereFilter)) {
        //     $total = $total->orWhere($whereFilter);
        // }
        $recordsFiltered = $queryFIltered->count();
        $recordsTotal = $queryTotal;
        // call api
        try {
            $output = array(
                "data" => $data,
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered
            );
        } catch (ClientException  $e) {
            $output = array(
                "data" => [],
                "recordsTotal" => 0,
                "recordsFiltered" => 0
            );
        }

        return response()->json($output);
    }
}
