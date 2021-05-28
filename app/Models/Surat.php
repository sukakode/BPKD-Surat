<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat';
    protected $fillable = [
        'pengirim', 'tgl_surat', 'nomor_surat', 'sifat', 'lampiran', 'perihal', 'surat_ditujukan', 'isi_singkat', 'tgl_terima', 'user_id',
    ];

    public function files()
    {
        return $this->hasMany('App\Models\SuratFile', 'surat_id', 'id');
    }

    public function disposisi()
    {
        return $this->hasMany('App\Models\Disposisi', 'surat_id', 'id');
    }
}
