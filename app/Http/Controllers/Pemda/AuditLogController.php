<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource with search, filtering, and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $modelFilter = $request->query('model');
        $roleFilter = $request->query('role');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = AuditLog::with('user');

        // Pencarian teks (aksi, nama user, email, alamat IP, model)
        if ($request->filled('search')) {
            $term = trim($search);
            $query->where(function ($q) use ($term) {
                $q->where('aksi', 'like', "%{$term}%")
                    ->orWhere('model', 'like', "%{$term}%")
                    ->orWhere('ip_address', 'like', "%{$term}%")
                    ->orWhereHas('user', function ($uq) use ($term) {
                        $uq->where('name', 'like', "%{$term}%")
                            ->orWhere('email', 'like', "%{$term}%");
                    });
            });
        }

        // Filter Model / Modul
        if ($request->filled('model')) {
            $query->where('model', $modelFilter);
        }

        // Filter Role Aktor
        if ($request->filled('role')) {
            $query->whereHas('user', function ($uq) use ($roleFilter) {
                $uq->where('role', $roleFilter);
            });
        }

        // Filter Rentang Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $logs = $query->latest('id')->paginate(15)->withQueryString();

        // Statistik Cepat untuk Dashboard Log Sistem
        $totalLogs = AuditLog::count();
        $logsHariIni = AuditLog::whereDate('created_at', \Carbon\Carbon::today())->count();
        $totalUsersAktif = AuditLog::whereNotNull('user_id')->distinct('user_id')->count('user_id');
        $distinctModels = AuditLog::whereNotNull('model')->distinct()->pluck('model');

        return view('dashboard.pemda.audit-log.index', compact(
            'logs',
            'totalLogs',
            'logsHariIni',
            'totalUsersAktif',
            'distinctModels',
            'search',
            'modelFilter',
            'roleFilter',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = AuditLog::with('user')->findOrFail($id);
        return view('dashboard.pemda.audit-log.show', compact('log'));
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
