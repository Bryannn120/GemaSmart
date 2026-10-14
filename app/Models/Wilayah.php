<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wilayah extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_wilayah', 'nama', 'jenis', 'parent_id', 'is_aktif'
    ];

    public function keluarga_penerimas()
    {
        return $this->hasMany(KeluargaPenerima::class);
    }

    public function keluargaPenerimas()
    {
        return $this->keluarga_penerimas();
    }

    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Wilayah::class, 'parent_id');
    }
}
