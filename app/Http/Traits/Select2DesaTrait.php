<?php

namespace App\Http\Traits;

use App\Helpers\Select2;
use App\Models\MsWilDesa;
use Illuminate\Support\Facades\DB;

trait Select2DesaTrait
{
    public function dataDesa()
    {
        $table = MsWilDesa::query();
        $table = $table->where('kdkec', request('kdkec'));
        return Select2::Generate($table, "kddesa", "nmdesa");
    }
}
