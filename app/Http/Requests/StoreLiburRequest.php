<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreLiburRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'harilibur' => 'required',
            'tgl_dari' => 'required',
            'tgl_sampai' => 'required',
            'catatan' => 'required',
            'created_by' => 'required',
            'created_at' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tgl_dari' => Carbon::make($this->tgl_dari),
            'tgl_sampai' => Carbon::make($this->tgl_sampai),
            'created_at' => Carbon::now()
        ]);
    }
}
