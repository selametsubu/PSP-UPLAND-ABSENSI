<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreAbsenHadirRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userid' => 'required',
            'tgl' => 'required',
            'waktu' => 'required',
            'waktu_bagian' => 'required',
            // 'is_absen_datang' => 'required',
            // 'is_absen_pulang' => 'required',
            'status_absen' => 'required',
            'status_spot' => 'nullable',
            'lat' => 'required',
            'lng' => 'required',
            'lokasi' => 'required',
            'prov' => 'nullable',
            'kab' => 'nullable',
            'kec' => 'nullable',
            'desa' => 'nullable',
            'catatan' => 'nullable',
            'swafoto' => 'nullable|mimes:png,jpg',
            'created_by' => 'required',
            'created_by' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tgl' => Carbon::make($this->tgl),
            'created_at' => Carbon::now()
        ]);
    }
}
