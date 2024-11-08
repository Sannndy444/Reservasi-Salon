<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->check() && auth()->user()->hasRole($role)) {
            return $next($request);
        }

        \Log::info('Role check failed for user: ', [
        'user' => auth()->user(),
        'required_role' => $role,
        ]);
        return redirect('/PageNotFound')->with('error', 'Anda Tidak Memiliki Akses Ke Halaman Tersebut.');
    }
}
