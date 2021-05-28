<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukUpdate extends FormRequest
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
            'pengirim' => 'required|string|max:50',
            'tgl_surat' => 'required|date', 
            'tgl_terima' => 'required|date', 
            'nomor_surat' => 'required|string|max:30',
            'sifat' => 'nullable|string|max:20',
            'lampiran' => 'nullable|string|max:50',
            'perihal' => 'required|string|max:100',
            'surat_ditujukan' => 'required|string|max:100',
            'isi_surat' => 'nullable|string|max:100',
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
            'mimes' => ':attribute harus berupa PDF !',
            'file' => ':attribute gagal di-upload !',
            'date' => ':attribute format tanggal salah !',
        ];
    }
    
    public function attributes()
    {
        return [
            'pengirim' => 'Pengirim Surat',
            'tgl_surat' => 'Tanggal Surat', 
            'tgl_terima' => 'Tanggal Terima Surat', 
            'nomor_surat' => 'Nomor Surat Surat' ,
            'sifat' => 'Sifat Surat' ,
            'lampiran' => 'Lampiran Surat',
            'perihal' => 'Perihal Surat',
            'surat_ditujukan' => 'Surat di-Tujukan',
            'isi_surat' => 'Isi Singkat Surat',
        ];
    }
}
