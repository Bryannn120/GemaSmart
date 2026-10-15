<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nim_nip',
        'fakultas_prodi',
        'email',
        'no_hp',
        'password',
        'role',
        'kampus_id',
        'status_keaktifan',
        'desa_penugasan',
    ];

    public function kampus()
    {
        return $this->belongsTo(KampusMitra::class, 'kampus_id');
    }

    public function keluargaPenerimas()
    {
        return $this->hasMany(KeluargaPenerima::class, 'pendamping_id');
    }

    public function laporanTumbuhKembangs()
    {
        return $this->hasMany(LaporanTumbuhKembang::class, 'pendamping_id');
    }

    public function penyaluranBantuans()
    {
        return $this->hasMany(PenyaluranBantuan::class, 'pendamping_id');
    }

    public function wilayahPenugasan()
    {
        return $this->belongsToMany(Wilayah::class, 'pendamping_wilayahs', 'user_id', 'wilayah_id')->withTimestamps();
    }

    /**
     * Ambil daftar ID desa binaan yang ditugaskan kepada pendamping ini.
     * Jika ditugaskan per kecamatan, otomatis mengekstrak seluruh ID desa di bawah kecamatan tersebut.
     */
    public function getAssignedDesaIds(): array
    {
        if ($this->role !== 'pendamping') {
            return [];
        }

        $assigned = $this->wilayahPenugasan;
        if ($assigned->isEmpty()) {
            return [];
        }

        $desaIds = [];
        foreach ($assigned as $w) {
            if ($w->jenis === 'desa') {
                $desaIds[] = $w->id;
            } elseif ($w->jenis === 'kecamatan') {
                $childIds = Wilayah::where('parent_id', $w->id)->pluck('id')->toArray();
                $desaIds = array_merge($desaIds, $childIds);
            }
        }

        return array_values(array_unique($desaIds));
    }

    /**
     * Label ringkas wilayah binaan pendamping untuk ditampilkan di header dan profil.
     */
    public function getAssignedWilayahLabelAttribute(): string
    {
        if ($this->role !== 'pendamping') {
            return 'Seluruh Wilayah';
        }

        $assigned = $this->wilayahPenugasan;
        if ($assigned->isEmpty()) {
            return $this->desa_penugasan ?: 'Belum Ada Penugasan';
        }

        $names = $assigned->map(function($w) {
            if ($w->jenis === 'kecamatan') {
                return "Kec. {$w->nama}";
            }
            return "Desa {$w->nama}";
        })->toArray();

        if (count($names) > 3) {
            return $names[0] . ', ' . $names[1] . ' (+' . (count($names) - 2) . ' desa lainnya)';
        }

        return implode(', ', $names);
    }

    /**
     * Ambil koleksi model Wilayah desa binaan lengkap dengan kecamatannya.
     */
    public function getAssignedDesasCollection()
    {
        $desaIds = $this->getAssignedDesaIds();
        if (empty($desaIds)) {
            return collect();
        }
        return Wilayah::with('parent')->whereIn('id', $desaIds)->orderBy('nama')->get();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
