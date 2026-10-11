<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KampusMitra extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'nama_universitas', 'pic_name', 'pic_contact', 'wilayah_binaan', 'mou_berlaku_sampai', 'status_mou'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
