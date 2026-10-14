<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenyaluranBantuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'keluarga_penerima_id',
        'program_bantuan_id',
        'item_bantuan_id',
        'pendamping_id',
        'jenis',
        'jumlah',
        'satuan',
        'nominal_uang',
        'peruntukan',
        'keterangan',
        'foto_penyerahan_url',
        'tgl_penyaluran',
        'status',
    ];

    protected $casts = [
        'tgl_penyaluran' => 'date',
        'jumlah' => 'decimal:2',
        'nominal_uang' => 'decimal:2',
    ];

    public function keluargaPenerima()
    {
        return $this->belongsTo(KeluargaPenerima::class, 'keluarga_penerima_id');
    }

    public function programBantuan()
    {
        return $this->belongsTo(ProgramBantuan::class);
    }

    public function itemBantuan()
    {
        return $this->belongsTo(ItemBantuan::class);
    }

    public function pendamping()
    {
        return $this->belongsTo(User::class, 'pendamping_id');
    }
}
