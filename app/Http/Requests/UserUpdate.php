<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            'nip' => 'required|numeric|digits_between:0,18|unique:users,nip,'.$this->pengguna->id,
            'nama' => 'required|string|max:35',
            'jabatan_id' => 'required|numeric|exists:jabatan,id',
            'notelp' => 'required|numeric|digits_between:0,14',
            'email' => 'required|email|confirmed|unique:users,email,'.$this->pengguna->id,
            'password' => 'nullable|string|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong !',
            'string' => 'Format isian harus berupa String !',
            'numeric' => 'Format isian harus berupa Angka !',
            'digits_between' => ':attribute tidak boleh lebih dari :digits_between digit !',
            'unique' => ':attribute data tersebut sudah ada !',
            'max' => ':attribute tidak boleh lebih dari :max karakter !',
            'exists' => ':attribute data tidak sesuai !',
            'confirmed' => ':attribute konfirmasi salah !',
        ];
    }
    
    public function attributes()
    {
        return [
            'nip' => 'NIP Pengguna',
            'nama' => 'Nama Pengguna',
            'jabatan_id' => 'Jabatan Pengguna',
            'notelp' => 'Nomor Telpon Pengguna',
            'email' => 'E-Mail Pengguna',
            'password' => 'Password',
        ];
    }

}
