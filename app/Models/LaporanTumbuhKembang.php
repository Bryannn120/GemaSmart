<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanTumbuhKembang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'keluarga_penerima_id', 'pendamping_id', 'tanggal_lapor', 'status_kondisi', 'catatan', 'foto_url'
    ];

    public function keluarga_penerima()
    {
        return $this->belongsTo(KeluargaPenerima::class, 'keluarga_penerima_id')->withTrashed();
    }

    public function keluargaPenerima()
    {
        return $this->keluarga_penerima();
    }

    public function pendamping()
    {
        return $this->belongsTo(User::class, 'pendamping_id');
    }
}
