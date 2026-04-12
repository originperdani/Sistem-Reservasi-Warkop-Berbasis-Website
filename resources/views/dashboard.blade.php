@extends('layouts.main')

@section('title', 'Dashboard - Warkop Pamulang')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Reset some bootstrap conflicts with tailwind if any */
        .navbar, .footer { font-family: 'Poppins', sans-serif !important; }
        main { font-family: 'Figtree', sans-serif !important; }
    </style>
@endpush

@section('content')
    <div class="py-12 bg-warkop-cream-light min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight mb-8">
                {{ __('My Reservations') }}
            </h2>

            @if(session('success'))
                <div class="bg-red-50 border border-warkop-red/20 text-warkop-red px-4 py-3 rounded-xl mb-6 relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Reservation Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 mb-8 border border-warkop-cream">
                        <h3 class="text-2xl font-bold mb-6 text-warkop-red flex items-center">
                            <i class="bi bi-calendar-plus me-3"></i> Reservasi Meja
                        </h3>
                        <form action="{{ route('reservasi.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-warkop-red-dark mb-2">Tanggal Reservasi</label>
                                    <input type="date" name="tanggal" min="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-warkop-red-dark mb-2">Waktu Reservasi</label>
                                    <input type="time" name="waktu" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-warkop-red-dark mb-2">Pilih Meja</label>
                                    <select name="meja_id" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                                        @foreach(\App\Models\Meja::where('status', 'tersedia')->get() as $meja)
                                            <option value="{{ $meja->id }}">{{ $meja->nama_meja }} (Kapasitas: {{ $meja->kapasitas }} orang)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-warkop-red-dark mb-2">Durasi (Jam)</label>
                                    <input type="number" name="durasi" min="1" max="12" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50" placeholder="contoh: 2" required>
                                </div>
                            </div>
                            <div class="mt-8">
                                <button type="submit" class="w-full bg-red-700 text-white px-8 py-4 rounded-xl font-bold hover:bg-red-800 transition duration-300 shadow-lg shadow-red-700/20 text-lg">
                                    Konfirmasi Reservasi
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-warkop-cream">
                        <h3 class="text-2xl font-bold mb-6 text-warkop-red flex items-center">
                            <i class="bi bi-clock-history me-3"></i> Reservasi Saya
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Meja</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Tanggal & Waktu</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Status DP</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-red-700 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @forelse(auth()->user()->reservasis as $res)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $res->meja->nama_meja }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $res->tanggal }} pada {{ $res->waktu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-red-600">Rp {{ number_format($res->pembayaran->jumlah_dp ?? 0, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                                {{ $res->status == 'valid' ? 'bg-green-100 text-green-800' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                                                {{ $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada reservasi.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Profile & Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-warkop-cream mb-8">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="bi bi-person text-4xl text-red-700"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h4>
                            <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl hover:bg-gray-50 transition text-gray-700">
                                <i class="bi bi-gear me-3"></i> Edit Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center p-3 rounded-xl hover:bg-red-50 transition text-red-600">
                                    <i class="bi bi-box-arrow-right me-3"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
