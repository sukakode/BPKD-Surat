<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_file';
    protected $fillable = [
        'surat_id', 'nama_file', 'lokasi_file',
    ];

    public function surat()
    {
        return $this->belongsTo('App\Models\Surat', 'surat_id', 'id');
    }
}
