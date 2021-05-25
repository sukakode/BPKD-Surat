<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JabatanDisposisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jabatan_disposisi';
    protected $fillable = [
        'jabatan_id', 'jabatan_dituju',
    ];

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'jabatan_id', 'id');
    }

    public function jabatan_tuju()
    {
        return $this->belongsTo('App\Models\Jabatan', 'jabatan_dituju', 'id');
    }
}
