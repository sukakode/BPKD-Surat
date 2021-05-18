<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JabatanStore extends FormRequest
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
            'nama' => 'required|string|max:35',
            'keterangan' => 'nullable|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama Jabatan',
            'keterangan' => 'Keterangan Jabatan',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong !',
            'string' => 'Format isian harus berupa String !',
            'max' => ':attribute tidak boleh lebih dari :max karakter !',
        ];
    }
}
