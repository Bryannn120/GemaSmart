<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Redirect based on actual role
        $role = $request->user()->role;
        switch ($role) {
            case 'pemda':
                return redirect('/dashboard/pemda');
            case 'kampus':
                return redirect('/dashboard/kampus');
            case 'pendamping':
                return redirect('/dashboard/pendamping');
            case 'validator':
                return redirect('/dashboard/validator');
            case 'penerima':
                return redirect('/dashboard/penerima');
            default:
                return redirect('/login');
        }
    }
}
