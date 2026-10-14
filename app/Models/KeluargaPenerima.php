<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeluargaPenerima extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no_kk', 'kepala_keluarga', 'nik', 'alamat', 'desil', 'penghasilan_perbulan',
        'wilayah_id', 'program_bantuan_id', 'status_validasi',
        'user_id', 'pendamping_id', 'kampus_id', 'status_kemandirian', 'is_flagged'
    ];

    public function getNamaAttribute()
    {
        return $this->kepala_keluarga ?: ($this->user ? $this->user->name : null);
    }

    public function getNamaKepalaKeluargaAttribute()
    {
        return $this->kepala_keluarga ?: ($this->user ? $this->user->name : null);
    }

    /**
     * Scope untuk penerima bantuan yang masih aktif (belum mandiri dan desil di bawah 6).
     * Penerima yang sudah mandiri atau mencapai desil 6 ke atas otomatis dikecualikan.
     */
    public function scopePenerimaAktif($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('desil')
              ->orWhere('desil', '<', 6);
        })->where(function ($q) {
            $q->whereNull('status_kemandirian')
              ->orWhereRaw('LOWER(status_kemandirian) != ?', ['mandiri']);
        });
    }

    /**
     * Scope untuk keluarga yang sudah mandiri atau mencapai desil 6 ke atas (lulus dari program).
     */
    public function scopeMandiri($query)
    {
        return $query->where(function ($q) {
            $q->where('desil', '>=', 6)
              ->orWhereRaw('LOWER(status_kemandirian) = ?', ['mandiri']);
        });
    }

    /**
     * Cek apakah keluarga penerima ini sudah mandiri / lulus (Desil >= 6 atau status mandiri).
     */
    public function getIsMandiriAttribute(): bool
    {
        return ($this->desil >= 6) || (strtolower((string)$this->status_kemandirian) === 'mandiri');
    }

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

    public function pendamping()
    {
        return $this->belongsTo(User::class, 'pendamping_id');
    }

    public function kampusMitra()
    {
        return $this->belongsTo(KampusMitra::class, 'kampus_id');
    }

    public function laporanPenerimas()
    {
        return $this->hasMany(LaporanPenerima::class);
    }

    public function penilaianKemandirians()
    {
        return $this->hasMany(PenilaianKemandirian::class);
    }

    public function laporanTumbuhKembangs()
    {
        return $this->hasMany(LaporanTumbuhKembang::class);
    }

    public function laporans()
    {
        return $this->hasMany(LaporanTumbuhKembang::class);
    }

    public function penyaluranBantuans()
    {
        return $this->hasMany(PenyaluranBantuan::class);
    }
}
