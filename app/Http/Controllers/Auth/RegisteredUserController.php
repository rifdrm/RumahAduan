<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterWarga; // Jangan lupa import ini
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Cek tabel master_wargas kolom no_kk. Jika tidak ada, tolak!
            'no_kk' => ['required', 'string', 'exists:master_wargas,no_kk'], 
            'no_hp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_kk' => ['required', 'image', 'max:2048'], // Max 2MB
        ], [
            // Pesan Error Custom (Bahasa Indonesia)
            'no_kk.exists' => 'Maaf, Nomor KK ini belum terdaftar di Data Warga RT. Silakan hubungi Pak RT.',
        ]);

        // 2. Upload Foto (Jika ada)
        $pathFoto = null;
        if ($request->hasFile('foto_kk')) {
            // Simpan ke folder storage/app/public/bukti_kk
            $pathFoto = $request->file('foto_kk')->store('bukti_kk', 'public');
        }

        // 3. Cari Data Master Warga berdasarkan No KK
        $wargaAsli = MasterWarga::where('no_kk', $request->no_kk)->first();

        // 4. Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'foto_kk' => $pathFoto,
            'role' => 'warga',
            'status_akun' => 'pending', // Default pending, nunggu admin klik approve
            'master_warga_id' => $wargaAsli->id, // Langsung link ke rumah asli
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}