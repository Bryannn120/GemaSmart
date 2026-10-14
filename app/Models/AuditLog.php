<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'aksi', 'model', 'model_id', 'data_lama', 'data_baru', 'ip_address',
    ];

    protected $casts = [
        'data_lama' => 'array',
        'data_baru' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper cepat untuk mencatat riwayat aktivitas sistem.
     */
    public static function record($aksi, $model = null, $modelId = null, $dataLama = null, $dataBaru = null, $userId = null)
    {
        try {
            return self::create([
                'user_id' => $userId ?? auth()->id(),
                'aksi' => $aksi,
                'model' => $model,
                'model_id' => $modelId,
                'data_lama' => $dataLama,
                'data_baru' => $dataBaru,
                'ip_address' => request()->ip() ?? '127.0.0.1',
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mencatat audit log: ' . $e->getMessage());
            return null;
        }
    }
}
