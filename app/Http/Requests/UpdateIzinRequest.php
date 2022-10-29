<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIzinRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userid' => 'required',
            'jenis_izin' => 'required',
            'aktifitas' => 'required',
            'tgl_dari' => 'required',
            'tgl_sampai' => 'required',
            'dok_ori' => 'required',
            'dok_saved' => 'required',
            'updated_by' => 'required',
            'updated_at' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tgl_dari' => Carbon::make($this->tgl_dari),
            'tgl_sampai' => Carbon::make($this->tgl_sampai),
            'updated_at' => Carbon::now()
        ]);
    }
}
