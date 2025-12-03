<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\AnggotaKeluarga; // Import Model Anggota

class ProfileController extends Controller
{
    /**
     * Tampilkan Halaman Profil
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        
        // Ambil data anggota keluarga yang sudah ada
        $anggotaKeluarga = $user->anggotaKeluargas;

        return view('profile.edit', [
            'user' => $user,
            'anggotaKeluarga' => $anggotaKeluarga,
        ]);
    }

    /**
     * Update Data Profil (Akun + Anggota)
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // 1. Update Data Akun Dasar (Nama & Email)
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // 2. Update/Tambah Anggota Keluarga
        // Data dikirim dalam bentuk array: name="anggota[0][nama]", dst.
        if ($request->has('anggota')) {
            foreach ($request->anggota as $data) {
                // Jika ada ID, update. Jika tidak, buat baru.
                if (isset($data['id']) && $data['id'] != null) {
                    $anggota = AnggotaKeluarga::find($data['id']);
                    if ($anggota && $anggota->user_id == $user->id) {
                        $anggota->update([
                            'nama_lengkap' => $data['nama'],
                            'status_hubungan' => $data['status'], // Hubungan Keluarga
                            'tgl_lahir' => $data['tgl_lahir'],
                            // NIK dihapus dari form user karena sensitif, atau bisa ditambahkan jika perlu
                        ]);
                    }
                } else {
                    // Buat Baru
                    // Pastikan field mandatory terisi
                    if (!empty($data['nama'])) {
                        AnggotaKeluarga::create([
                            'user_id' => $user->id,
                            'nama_lengkap' => $data['nama'],
                            'nik' => rand(100000, 999999), // Dummy NIK sementara, harusnya diinput
                            'status_hubungan' => $data['status'],
                            'tgl_lahir' => $data['tgl_lahir'],
                        ]);
                    }
                }
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus Akun (Bawaan Breeze - Pertahankan)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    // Fitur Hapus Anggota (Via AJAX atau Form Terpisah) bisa ditambahkan nanti
}