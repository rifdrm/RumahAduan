<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterWarga;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input (Sistem Satpam Otomatis)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // KUNCI UTAMA: Cek apakah No KK ada di tabel master_wargas?
            'no_kk' => ['required', 'string', 'exists:master_wargas,no_kk'], 
            'no_hp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_kk' => ['required', 'image', 'max:2048'], 
        ], [
            'no_kk.exists' => 'Nomor KK tidak dikenali! Pastikan Anda warga terdaftar.',
        ]);

        // 2. Upload Foto (Tetap kita simpan sebagai arsip admin)
        $pathFoto = null;
        if ($request->hasFile('foto_kk')) {
            $pathFoto = $request->file('foto_kk')->store('bukti_kk', 'public');
        }

        // 3. Ambil ID Master Warga
        $wargaAsli = MasterWarga::where('no_kk', $request->no_kk)->first();

        // 4. Buat User Baru (LANGSUNG ACTIVE)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'foto_kk' => $pathFoto,
            'role' => 'warga',
            'status_akun' => 'active', // <--- PERUBAHAN DISINI (Auto Approve)
            'master_warga_id' => $wargaAsli->id, 
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Langsung masuk dashboard, tidak perlu ke ruang tunggu
        return redirect(route('dashboard', absolute: false));
    }
}