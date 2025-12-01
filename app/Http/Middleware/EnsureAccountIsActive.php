<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil data user yang sedang login
        $user = $request->user();

        // Jika user belum login, biarkan lanjut (nanti dihandle auth middleware lain)
        if (! $user) {
            return $next($request);
        }

        // ATURAN 1: Jika Role Admin, boleh lewat
        if ($user->role === 'admin') {
            return $next($request);
        }

        // ATURAN 2: Jika Status PENDING, tendang ke halaman 'tunggu'
        if ($user->status_akun === 'pending') {
            // Jangan redirect kalau user SUDAH di halaman 'tunggu' (biar gak loop)
            if ($request->routeIs('verifikasi.notice')) {
                return $next($request);
            }
            return redirect()->route('verifikasi.notice');
        }

        // ATURAN 3: Jika Status REJECTED, tendang ke halaman 'tolak'
        if ($user->status_akun === 'rejected') {
            if ($request->routeIs('verifikasi.rejected')) {
                return $next($request);
            }
            return redirect()->route('verifikasi.rejected');
        }

        // Jika status ACTIVE, silakan masuk
        return $next($request);
    }
}
