<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSysUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required',
            'nickname' => 'required',
            'nik' => 'required|unique:sys_user,nik,0,userid',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'aktif' => 'required',
            'telpno' => 'required',
            'alamat' => 'nullable|max:255',
            'wajib_absen' => 'required',
            'spotid' => 'nullable',
            'email' => 'required|email|unique:sys_user,email,0,userid',
            'password' => 'required|confirmed',
            'roleid' => 'required',
            'kdkab' => 'nullable',
            'kdkec' => 'nullable',
            'kddesa' => 'nullable',
            'created_by' => 'required',
        ];
    }
}
