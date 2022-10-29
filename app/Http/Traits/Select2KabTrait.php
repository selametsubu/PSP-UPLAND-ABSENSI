<?php

namespace App\Http\Traits;

use App\Helpers\Select2;
use App\Models\MsWilKab;

trait Select2KabTrait
{
    public function dataKab()
    {
        $table = MsWilKab::query()->where('is_primary', 1);
        return Select2::Generate($table, "kdkab", "nmkab");
    }
}
