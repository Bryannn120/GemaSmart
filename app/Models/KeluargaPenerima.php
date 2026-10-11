<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluargaPenerima extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no_kk', 'kepala_keluarga', 'nik', 'alamat', 'desil',
        'wilayah_id', 'program_bantuan_id', 'status_validasi',
        'user_id', 'status_kemandirian', 'is_flagged'
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function programBantuan()
    {
        return $this->belongsTo(ProgramBantuan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporanPenerimas()
    {
        return $this->hasMany(LaporanPenerima::class);
    }

    public function penilaianKemandirians()
    {
        return $this->hasMany(PenilaianKemandirian::class);
    }
}
