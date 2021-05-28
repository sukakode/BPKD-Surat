<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'disposisi';
    protected $fillable = [
        'surat_id', 'penginput_id', 'diteruskan', 'catatan', 'status_penginput', 'status_penerima', 'disposisi_sebelumnya', 'disposisi_selanjutnya',
    ];

    public function penginput()
    {
        return $this->belongsTo('App\Models\User', 'penginput_id', 'id');
    }

    public function diteruskanUser()
    {
        return $this->belongsTo('App\Models\User', 'diteruskan', 'id');
    }

    public function surat()
    {
        return $this->belongsTo('App\Models\Surat', 'surat_id', 'id');
    }
}
