<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpotRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'spot' => 'required',
            'radius' => 'required|numeric',
            'alamat' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'catatan' => 'nullable|max:4000',
            'updated_by' => 'required',
        ];
    }
}
