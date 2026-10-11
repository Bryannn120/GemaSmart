<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaianKemandirian extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_kemandirian_id', 'indikator_kemandirian_id', 'nilai'
    ];

    public function indikator()
    {
        return $this->belongsTo(IndikatorKemandirian::class, 'indikator_kemandirian_id');
    }
}
