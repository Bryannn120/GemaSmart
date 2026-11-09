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
     * Tampilkan form penginputan penilaian tolak ukur indikator kemandirian untuk keluarga penerima.
     */
    public function create(string $id)
    {
        $keluarga_penerima = KeluargaPenerima::with(['wilayah', 'programBantuan', 'penilaianKemandirians' => function($q) {
            $q->latest();
        }])->findOrFail($id);

        return view('dashboard.pendamping.keluarga_penerima.penilaian.create', compact('keluarga_penerima'));
    }

    /**
     * Simpan hasil penilaian dan hitung tolak ukur pendapatan & pengeluaran serta indikator kemandirian otomatis oleh sistem.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'periode' => 'required|string|max:100',
            'tipe_periode' => 'required|in:per_bulan,per_hari',
            'pendapatan' => 'required|numeric|min:0',
            'pengeluaran' => 'required|numeric|min:0',
            'jumlah_anak' => 'required|integer|min:0|max:25',
            'aset_rumah' => 'required|in:tidak_layak,semi_permanen,permanen',
            'aset_tanah' => 'required|in:tidak_ada,sempit,sedang,luas',
            'aset_kendaraan' => 'required|in:tidak_ada,motor_tua,motor_layak,mobil',
            'catatan' => 'nullable|string|max:1000',
        ], [
            'periode.required' => 'Periode penilaian wajib diisi (contoh: Bulan Oktober 2026 / Triwulan IV).',
            'tipe_periode.required' => 'Basis waktu tolak ukur wajib dipilih (Per Bulan atau Per Hari).',
            'pendapatan.required' => 'Nilai pendapatan keluarga wajib diisi.',
            'pendapatan.numeric' => 'Pendapatan harus berupa angka nominal.',
            'pengeluaran.required' => 'Nilai pengeluaran pokok keluarga wajib diisi.',
            'pengeluaran.numeric' => 'Pengeluaran harus berupa angka nominal.',
            'jumlah_anak.required' => 'Jumlah anak / tanggungan keluarga wajib diisi.',
            'aset_rumah.required' => 'Kondisi rumah wajib dipilih.',
            'aset_tanah.required' => 'Kepemilikan lahan/tanah wajib dipilih.',
            'aset_kendaraan.required' => 'Kepemilikan kendaraan wajib dipilih.',
        ]);

        $keluarga = KeluargaPenerima::findOrFail($id);
        $desilLama = $keluarga->desil;
        $statusLama = $keluarga->status_kemandirian;
        $penghasilanLama = $keluarga->penghasilan_perbulan ?? 0;

        $pendapatan = (float) $request->pendapatan;
        $pengeluaran = (float) $request->pengeluaran;
        $tipePeriode = $request->tipe_periode;

        // Hitung tolak ukur dan desil secara objektif dan sistematis
        $hasil = DesilCalculatorService::hitung(
            pendapatan: $pendapatan,
            pengeluaran: $pengeluaran,
            tipePeriode: $tipePeriode,
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
            'tipe_periode' => $hasil['tipe_periode'],
            'pendapatan' => $hasil['pendapatan'],
            'pengeluaran' => $hasil['pengeluaran'],
            'pendapatan_perbulan' => $hasil['pendapatan_perbulan'],
            'pengeluaran_perbulan' => $hasil['pengeluaran_perbulan'],
            'penghasilan_bersih' => $hasil['penghasilan_bersih'],
            'penghasilan_perbulan' => $hasil['pendapatan_perbulan'],
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

        // Update data profil keluarga penerima dengan tolak ukur terbaru
        $keluarga->desil = $hasil['desil'];
        $keluarga->tipe_periode = $hasil['tipe_periode'];
        $keluarga->pendapatan = $hasil['pendapatan'];
        $keluarga->pengeluaran = $hasil['pengeluaran'];
        $keluarga->pendapatan_perbulan = $hasil['pendapatan_perbulan'];
        $keluarga->pengeluaran_perbulan = $hasil['pengeluaran_perbulan'];
        $keluarga->penghasilan_bersih = $hasil['penghasilan_bersih'];
        $keluarga->penghasilan_perbulan = $hasil['pendapatan_perbulan'];
        $keluarga->status_kemandirian = $hasil['status_kemandirian'];
        $keluarga->save();

        // Audit Trail
        AuditLog::create([
            'user_id' => Auth::id(),
            'aksi' => 'Input Penilaian Tolak Ukur Kemandirian',
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
                'tipe_periode' => $hasil['tipe_periode'],
                'pendapatan' => $hasil['pendapatan'],
                'pengeluaran' => $hasil['pengeluaran'],
                'pendapatan_perbulan' => $hasil['pendapatan_perbulan'],
                'pengeluaran_perbulan' => $hasil['pengeluaran_perbulan'],
                'penghasilan_bersih' => $hasil['penghasilan_bersih'],
                'total_skor' => $hasil['total_skor'],
                'status_perkembangan' => $hasil['status_perkembangan'],
            ],
            'ip_address' => $request->ip(),
        ]);

        $statusSurplus = $hasil['penghasilan_bersih'] >= 0 ? "Surplus: Rp " . number_format($hasil['penghasilan_bersih'], 0, ',', '.') : "Defisit: Rp " . number_format(abs($hasil['penghasilan_bersih']), 0, ',', '.');
        $pesan = "Penilaian tolak ukur berhasil disimpan! Sistem menetapkan " . $hasil['kategori_desil'] . 
                 " (" . $statusSurplus . "/bln, Skor: " . $hasil['total_skor'] . ", Status: " . $hasil['status_kemandirian'] . ").";

        return redirect()->route('pendamping.keluarga_penerima.show', $keluarga->id)
            ->with('success', $pesan);
    }
}
