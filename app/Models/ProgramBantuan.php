<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramBantuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kampus_id',
        'nama_program',
        'deskripsi',
        'pagu_anggaran',
        'target_kk',
        'tahun_anggaran',
        'jenis_subsidi',
        'status',
    ];

    public function kampusMitra()
    {
        return $this->belongsTo(KampusMitra::class, 'kampus_id');
    }

    public function itemBantuans()
    {
        return $this->hasMany(ItemBantuan::class);
    }

    public function penyaluranBantuans()
    {
        return $this->hasMany(PenyaluranBantuan::class);
    }

    public function keluargaPenerimas()
    {
        return $this->hasMany(KeluargaPenerima::class);
    }

    public function laporanTumbuhKembangs()
    {
        return $this->hasMany(LaporanTumbuhKembang::class);
    }
}
