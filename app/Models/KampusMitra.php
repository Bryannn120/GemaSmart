<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KampusMitra extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'nama_universitas', 'pic_name', 'pic_contact', 'wilayah_binaan', 'mou_berlaku_sampai', 'status_mou', 'dana_bappeda'
    ];

    protected $casts = [
        'dana_bappeda' => 'decimal:2',
        'mou_berlaku_sampai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNamaKampusAttribute()
    {
        return $this->nama_universitas ?? $this->attributes['nama_kampus'] ?? 'Kampus Mitra';
    }

    public function programBantuans()
    {
        return $this->hasMany(ProgramBantuan::class, 'kampus_id');
    }

    public function pendampings()
    {
        return $this->hasMany(User::class, 'kampus_id')->where('role', 'pendamping');
    }

    public function getTotalPenggunaanDanaAttribute()
    {
        $penyalurans = PenyaluranBantuan::where(function($q) {
            $q->whereHas('programBantuan', function($pb) {
                $pb->where('kampus_id', $this->id);
            })->orWhereHas('pendamping', function($p) {
                $p->where('kampus_id', $this->id);
            });
        })->where('status', '!=', 'batal')
          ->with('itemBantuan')
          ->get();

        if ($penyalurans->isEmpty() && self::count() <= 1) {
            $penyalurans = PenyaluranBantuan::where('status', '!=', 'batal')->with('itemBantuan')->get();
        }

        $total = 0;
        foreach ($penyalurans as $p) {
            if ($p->jenis === 'uang' && (float)$p->nominal_uang > 0) {
                $total += (float)$p->nominal_uang;
            } else {
                $hargaSatuan = (float)($p->itemBantuan->nominal_satuan ?? 0);
                $total += ((float)$p->jumlah * $hargaSatuan);
            }
        }
        return $total;
    }

    public function getSisaDanaAttribute()
    {
        return max(0, (float)$this->dana_bappeda - $this->total_penggunaan_dana);
    }

    public function getPersentasePenggunaanAttribute()
    {
        if ((float)$this->dana_bappeda <= 0) return 0;
        return min(100, round(($this->total_penggunaan_dana / (float)$this->dana_bappeda) * 100, 1));
    }
}

