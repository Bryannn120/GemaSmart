<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKemandirian extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluarga_penerima_id', 'pendamping_id', 'periode',
        'total_skor', 'status_perkembangan'
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
