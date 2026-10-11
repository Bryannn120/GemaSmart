<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKemandirian extends Model
{
    use HasFactory;

    protected $fillable = ['nama_indikator', 'bobot'];
}
