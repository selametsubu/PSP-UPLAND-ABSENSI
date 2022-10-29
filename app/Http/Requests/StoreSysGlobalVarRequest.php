<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSysGlobalVarRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'varname' => 'required|max:50|unique:absen_sys_globalvar,varname,0,varname',
            'display_name' => 'required|max:100',
            'vardesc' => 'required|max:1000',
            'val' => 'required|max:500',
            'tags' => 'nullable|max:4000',
            'guide' => 'nullable|max:500',
        ];
    }
}
