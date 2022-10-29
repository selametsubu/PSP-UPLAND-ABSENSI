<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSysGlobalVarRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'display_name' => 'required|max:100',
            'vardesc' => 'required|max:1000',
            'val' => 'required|max:500',
            'tags' => 'nullable|max:4000',
        ];
    }
}
