<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;
        $layout = 'layouts.' . $role; // misal: layouts.pemda, layouts.kampus

        $assignedDesas = $role === 'pendamping' ? $user->getAssignedDesasCollection() : collect();
        $totalBinaan = $role === 'pendamping' ? $user->keluargaPenerimas()->count() : 0;

        return view('profile.index', compact('layout', 'role', 'user', 'assignedDesas', 'totalBinaan'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password saat ini tidak sesuai dengan data kami.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah. Silakan gunakan password baru pada saat login berikutnya.');
    }
}
