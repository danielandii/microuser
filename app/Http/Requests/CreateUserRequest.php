<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            //
            'username' => 'required | unique:users',
            'password' => 'required | min:6',
            'department_id' => 'required | numeric',
            'jabatan_id' => 'required | numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'email|unique:users',
            'telp' => 'unique:users,telp'
        ];
    }

    protected function messages()
    {
        return [
            'required' => ':wajib diisi cuy!!!',
            'unique' => ':sudah terdaftar, cari yang lain!',
            'min' => ':attribute harus diisi minimal :min karakter ya cuy!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
            'email' => ':Input Email',
            'telp' => ':nomor sudah terdaftar'
        ];
    }
}
