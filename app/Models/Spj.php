<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spj extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kampus_id', 'nomor_spj', 'tgl_pengajuan', 'uraian', 'nominal', 'status', 'dokumen_spj_url'
    ];

    public function kampus()
    {
        return $this->belongsTo(KampusMitra::class, 'kampus_id');
    }
}
