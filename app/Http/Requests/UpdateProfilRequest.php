<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fullname' => 'required',
            'nickname' => 'required',
            'nik' => 'required|unique:sys_user,nik,' . request()->segment(3) . ',userid',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'telpno' => 'required',
            'alamat' => 'nullable|max:255',
            'email' => 'required|email|unique:sys_user,email,' . request()->segment(3) . ',userid',
            'modified_by' => 'required',
            'avatar_remove' => 'nullable'
        ];
    }
}
