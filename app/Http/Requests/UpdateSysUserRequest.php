<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSysUserRequest extends FormRequest
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
            'aktif' => 'required',
            'telpno' => 'required',
            'alamat' => 'nullable|max:255',
            'wajib_absen' => 'required',
            'spotid' => 'nullable',
            'email' => 'required|email|unique:sys_user,email,' . request()->segment(3) . ',userid',
            'password' => $this->password ? 'required|confirmed' : 'nullable',
            'roleid' => 'required',
            'kdkab' => 'nullable',
            'kdkec' => 'nullable',
            'kddesa' => 'nullable',
            'modified_by' => 'required',
            'avatar_remove' => 'nullable'
        ];
    }
}
