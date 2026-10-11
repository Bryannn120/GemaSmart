<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PendampingController extends Controller
{
    /**
     * Display a listing of pendamping users.
     */
    public function index()
    {
        $pendampings = User::where('role', 'pendamping')->get();
        return view('dashboard.kampus.pendamping.index', compact('pendampings'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pendamping = User::where('role', 'pendamping')->findOrFail($id);
        return view('dashboard.kampus.pendamping.show', compact('pendamping'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
