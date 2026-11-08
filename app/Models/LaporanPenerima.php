<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluarga_penerima_id',
        'pengirim_nama',
        'laporan_teks',
        'foto',
        'sumber',
        'wa_sender',
        'wa_message_id',
        'status_laporan',
        'tanggapan',
        'is_read_by_pemda',
        'is_read_by_kampus',
        'is_read_by_pendamping'
    ];

    public function keluargaPenerima()
    {
        return $this->belongsTo(KeluargaPenerima::class, 'keluarga_penerima_id')->withTrashed();
    }

    public function keluarga_penerima()
    {
        return $this->keluargaPenerima();
    }

    public function getIsWhatsappAttribute(): bool
    {
        return strtolower((string)$this->sumber) === 'whatsapp';
    }

    public function getFormattedWaSenderAttribute(): string
    {
        if (!$this->wa_sender) {
            return '-';
        }
        $num = preg_replace('/\D/', '', $this->wa_sender);
        if (str_starts_with($num, '62')) {
            return '+62 ' . substr($num, 2, 3) . '-' . substr($num, 5, 4) . '-' . substr($num, 9);
        }
        return $this->wa_sender;
    }
}
