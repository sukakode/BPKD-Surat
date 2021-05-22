<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukFileAdd extends FormRequest
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
            'surat_file' => 'required',
            'surat_file.*' => 'file|mimes:pdf|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong !',
            'max' => ':attribute tidak boleh lebih dari :max mb !',
            'mimes' => ':attribute harus berupa PDF !',
            'file' => ':attribute gagal di-upload !',
        ];
    }
    
    public function attributes()
    {
        return [
            'surat_file' => 'File Surat',
            'surat_file.*' => 'File Surat',
        ];
    }
}
