<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PendampingController extends Controller
{
    public function index()
    {
        $pendampings = User::where('role', 'pendamping')->get();
        return view('dashboard.pemda.pendamping.index', compact('pendampings'));
    }

    public function create()
    {
        return view('dashboard.pemda.pendamping.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['role'] = 'pendamping';
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('pemda.pendamping.index')->with('success', 'Pendamping berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);
        return view('dashboard.pemda.pendamping.show', compact('pendamping'));
    }

    public function edit(string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);
        return view('dashboard.pemda.pendamping.edit', compact('pendamping'));
    }

    public function update(Request $request, string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pendamping->id,
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pendamping->update($validated);

        return redirect()->route('pemda.pendamping.index')->with('success', 'Pendamping berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);
        $pendamping->delete();

        return redirect()->route('pemda.pendamping.index')->with('success', 'Pendamping berhasil dihapus.');
    }
}
