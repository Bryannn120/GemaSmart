<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValidasiCpcl extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'keluarga_penerima_id', 'pendamping_id', 'validator_id', 'tgl_survei', 'status_kelayakan', 'status_approval_pemda', 'catatan', 'foto_lahan_url'
    ];

    public function keluarga_penerima()
    {
        return $this->belongsTo(KeluargaPenerima::class);
    }

    public function pendamping()
    {
        return $this->belongsTo(User::class, 'pendamping_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}
