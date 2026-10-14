<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluarga_penerima_id', 'laporan_teks', 'foto', 'is_read_by_pemda'
    ];

    public function keluargaPenerima()
    {
        return $this->belongsTo(KeluargaPenerima::class, 'keluarga_penerima_id')->withTrashed();
    }

    public function keluarga_penerima()
    {
        return $this->keluargaPenerima();
    }
}
