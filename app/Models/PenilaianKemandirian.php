<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKemandirian extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluarga_penerima_id',
        'pendamping_id',
        'periode',
        'penghasilan_perbulan',
        'jumlah_anak',
        'aset_rumah',
        'aset_tanah',
        'aset_kendaraan',
        'pendapatan_per_kapita',
        'desil_sebelumnya',
        'desil_hasil',
        'total_skor',
        'status_perkembangan',
        'catatan',
    ];

    public function keluargaPenerima()
    {
        return $this->belongsTo(KeluargaPenerima::class);
    }

    public function pendamping()
    {
        return $this->belongsTo(User::class, 'pendamping_id');
    }

    public function detailPenilaians()
    {
        return $this->hasMany(DetailPenilaianKemandirian::class);
    }
}
