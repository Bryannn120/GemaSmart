<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemBantuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_bantuan_id',
        'jenis',
        'nama_item',
        'satuan',
        'deskripsi',
        'nominal_satuan',
        'total_stok',
    ];

    public function programBantuan()
    {
        return $this->belongsTo(ProgramBantuan::class);
    }

    public function penyaluranBantuans()
    {
        return $this->hasMany(PenyaluranBantuan::class);
    }

    public function getTotalDisalurkanAttribute()
    {
        return $this->penyaluranBantuans()->where('status', '!=', 'batal')->sum('jumlah');
    }

    public function getSisaStokAttribute()
    {
        return max(0, $this->total_stok - $this->total_disalurkan);
    }
}
