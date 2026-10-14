<?php

namespace App\Http\Controllers\Pendamping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KeluargaPenerima;
use App\Models\PenilaianKemandirian;
use App\Models\AuditLog;
use App\Services\DesilCalculatorService;

class PenilaianKemandirianController extends Controller
{
    /**
     * Tampilkan form penginputan penilaian subjektif desil untuk keluarga penerima.
     */
    public function create(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with(['wilayah', 'programBantuan', 'penilaianKemandirians' => function($q) {
            $q->latest();
        }])->findOrFail($id);

        return view('dashboard.pendamping.keluarga_penerima.penilaian.create', compact('keluarga_penerima'));
    }

    /**
     * Simpan hasil penilaian dan hitung desil otomatis oleh sistem.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'periode' => 'required|string|max:100',
            'penghasilan_perbulan' => 'required|numeric|min:0',
            'jumlah_anak' => 'required|integer|min:0|max:25',
            'aset_rumah' => 'required|in:tidak_layak,semi_permanen,permanen',
            'aset_tanah' => 'required|in:tidak_ada,sempit,sedang,luas',
            'aset_kendaraan' => 'required|in:tidak_ada,motor_tua,motor_layak,mobil',
            'catatan' => 'nullable|string|max:1000',
        ], [
            'periode.required' => 'Periode penilaian wajib diisi (contoh: Bulan Oktober 2026 / Triwulan IV).',
            'penghasilan_perbulan.required' => 'Penghasilan per bulan wajib diisi.',
            'penghasilan_perbulan.numeric' => 'Penghasilan per bulan harus berupa angka.',
            'jumlah_anak.required' => 'Jumlah anak / tanggungan keluarga wajib diisi.',
            'aset_rumah.required' => 'Kondisi rumah wajib dipilih.',
            'aset_tanah.required' => 'Kepemilikan lahan/tanah wajib dipilih.',
            'aset_kendaraan.required' => 'Kepemilikan kendaraan wajib dipilih.',
        ]);

        $keluarga = KeluargaPenerima::findOrFail($id);
        $desilLama = $keluarga->desil;
        $statusLama = $keluarga->status_kemandirian;
        $penghasilanLama = $keluarga->penghasilan_perbulan ?? 0;

        $penghasilan = (float) ($request->penghasilan_perbulan ?? $request->penghasilanPerbulan ?? 0);

        // Hitung desil secara objektif dan sistematis sesuai regulasi desil kemiskinan
        $hasil = DesilCalculatorService::hitung(
            penghasilanPerbulan: $penghasilan,
            jumlahAnak: (int) $request->jumlah_anak,
            asetRumah: $request->aset_rumah,
            asetTanah: $request->aset_tanah,
            asetKendaraan: $request->aset_kendaraan,
            desilSebelumnya: $desilLama
        );

        // Simpan data penilaian ke riwayat penilaian kemandirian
        $penilaian = PenilaianKemandirian::create([
            'keluarga_penerima_id' => $keluarga->id,
            'pendamping_id' => Auth::id(),
            'periode' => $request->periode,
            'penghasilan_perbulan' => $penghasilan,
            'jumlah_anak' => $request->jumlah_anak,
            'aset_rumah' => $request->aset_rumah,
            'aset_tanah' => $request->aset_tanah,
            'aset_kendaraan' => $request->aset_kendaraan,
            'pendapatan_per_kapita' => $hasil['pendapatan_per_kapita'],
            'desil_sebelumnya' => $desilLama,
            'desil_hasil' => $hasil['desil'],
            'total_skor' => $hasil['total_skor'],
            'status_perkembangan' => $hasil['status_perkembangan'],
            'catatan' => $request->catatan,
        ]);

        // Update data profil keluarga penerima dengan hasil penilaian terbaru
        $keluarga->desil = $hasil['desil'];
        $keluarga->penghasilan_perbulan = $penghasilan;
        $keluarga->status_kemandirian = $hasil['status_kemandirian'];
        $keluarga->save();

        // Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Input Penilaian Desil Kemandirian',
            'model' => 'PenilaianKemandirian',
            'model_id' => $penilaian->id,
            'data_lama' => [
                'desil' => $desilLama,
                'status_kemandirian' => $statusLama,
                'penghasilan_perbulan' => $penghasilanLama,
            ],
            'data_baru' => [
                'desil' => $hasil['desil'],
                'status_kemandirian' => $hasil['status_kemandirian'],
                'penghasilan_perbulan' => $request->penghasilan_perbulan,
                'total_skor' => $hasil['total_skor'],
                'status_perkembangan' => $hasil['status_perkembangan'],
            ],
            'ip_address' => $request->ip(),
        ]);

        $pesan = "Penilaian berhasil disimpan! Sistem menetapkan " . $hasil['kategori_desil'] . 
                 " dengan Total Skor: " . $hasil['total_skor'] . " (Status: " . $hasil['status_kemandirian'] . ").";

        return redirect()->route('pendamping.keluarga_penerima.show', $keluarga->id)
            ->with('success', $pesan);
    }
}
