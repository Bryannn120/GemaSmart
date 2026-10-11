<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramBantuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'pagu_anggaran',
        'target_kk',
        'tahun_anggaran',
        'status',
    ];
}
