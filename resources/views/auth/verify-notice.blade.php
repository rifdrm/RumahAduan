<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        <h2 class="text-xl font-bold text-gray-800 mb-2">⏳ Pendaftaran Sedang Diproses</h2>
        <p>Halo, <strong>{{ Auth::user()->name }}</strong>.</p>
        <p class="mt-2">
            Terima kasih telah mendaftar. Saat ini data Anda sedang 
            <span class="font-bold text-yellow-600">MENUNGGU VERIFIKASI</span> 
            oleh Admin.
        </p>
        <p class="mt-2">
            Silakan tunggu 1x24 jam. Kami akan mencocokkan data No KK dan Foto Bukti yang Anda kirimkan.
        </p>
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>