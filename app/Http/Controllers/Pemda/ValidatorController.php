<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ValidatorController extends Controller
{
    public function index()
    {
        $validators = User::where('role', 'validator')->get();
        return view('dashboard.pemda.validator.index', compact('validators'));
    }

    public function create()
    {
        return view('dashboard.pemda.validator.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['role'] = 'validator';
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('pemda.validator.index')->with('success', 'Validator berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $validator = User::where('role', 'validator')->findOrFail($id);
        return view('dashboard.pemda.validator.show', compact('validator'));
    }

    public function edit(string $id)
    {
        $validator = User::where('role', 'validator')->findOrFail($id);
        return view('dashboard.pemda.validator.edit', compact('validator'));
    }

    public function update(Request $request, string $id)
    {
        $validator = User::where('role', 'validator')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $validator->id,
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validator->update($validated);

        return redirect()->route('pemda.validator.index')->with('success', 'Validator berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $validator = User::where('role', 'validator')->findOrFail($id);
        $validator->delete();

        return redirect()->route('pemda.validator.index')->with('success', 'Validator berhasil dihapus.');
    }
}
