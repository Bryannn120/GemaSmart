<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramBantuan;

class ProgramBantuanController extends Controller
{
    /**
     * Display a listing of programs created by Kampus (Read-Only for Pemda monitoring).
     */
    public function index()
    {
        $programs = ProgramBantuan::with(['kampusMitra', 'itemBantuans', 'penyaluranBantuans'])
            ->withCount(['itemBantuans', 'penyaluranBantuans'])
            ->latest()
            ->get();

        return view('dashboard.pemda.program-bantuan.index', compact('programs'));
    }

    /**
     * Display the specified program details.
     */
    public function show(string $id)
    {
        $program = ProgramBantuan::with([
            'kampusMitra',
            'itemBantuans.penyaluranBantuans',
            'penyaluranBantuans.keluargaPenerima.wilayah'
        ])->findOrFail($id);

        return view('dashboard.pemda.program-bantuan.show', compact('program'));
    }

    /**
     * Pemda cannot create programs. Redirect with notice.
     */
    public function create()
    {
        return redirect()->route('pemda.program-bantuan.index')
            ->with('info', 'Program bantuan dirancang dan dibuat oleh pihak Kampus Mitra. Pemda bertindak sebagai pengawas dan monitoring daerah.');
    }

    public function store(Request $request)
    {
        return redirect()->route('pemda.program-bantuan.index')
            ->with('info', 'Program bantuan dirancang dan dibuat oleh pihak Kampus Mitra.');
    }

    public function edit(string $id)
    {
        return redirect()->route('pemda.program-bantuan.index')
            ->with('info', 'Pengubahan program bantuan hanya dapat dilakukan oleh pihak Kampus pembuat program.');
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('pemda.program-bantuan.index')
            ->with('info', 'Pengubahan program bantuan hanya dapat dilakukan oleh pihak Kampus pembuat program.');
    }

    public function destroy(string $id)
    {
        return redirect()->route('pemda.program-bantuan.index')
            ->with('info', 'Program bantuan dikelola oleh pihak Kampus Mitra.');
    }
}
