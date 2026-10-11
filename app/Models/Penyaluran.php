<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyaluran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomor_bast', 'tgl_kirim', 'wilayah_id', 'jenis_bibit_id', 'kuantitas', 'status', 'dokumen_bast_url'
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function jenisBibit()
    {
        return $this->belongsTo(JenisBibit::class);
    }
}
