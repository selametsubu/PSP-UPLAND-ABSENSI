<?php

namespace App\Http\Traits;

use App\Helpers\Select2;
use App\Models\MsWilKec;
use Illuminate\Support\Facades\DB;

trait Select2KecTrait
{
    public function dataKec()
    {
        $table = MsWilKec::query();
        $table = $table->where('kdkab', request('kdkab'));
        return Select2::Generate($table, "kdkec", "nmkec");
    }
}
