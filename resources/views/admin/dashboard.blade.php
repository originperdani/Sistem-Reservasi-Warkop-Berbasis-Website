<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            {{ __('Dashboard Admin') }} <span class="text-warkop-red">- Warkop Pamulang</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8" data-aos="fade-right">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    {{ __('Ringkasan Dashboard') }}
                </h2>
                <p class="text-gray-500 mt-1">Pantau performa Warkop Anda dan kelola reservasi pelanggan.</p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm rounded-3xl p-8 border border-white/50 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-warkop-red/10 rounded-2xl">
                            <i class="bi bi-wallet2 text-2xl text-warkop-red"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Total Pemasukan</div>
                            <div class="text-2xl font-black text-gray-900 leading-none">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm rounded-3xl p-8 border border-white/50 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-warkop-red/10 rounded-2xl">
                            <i class="bi bi-calendar-check text-2xl text-warkop-red"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Total Reservasi</div>
                            <div class="text-2xl font-black text-gray-900 leading-none">{{ $total_reservasi }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm rounded-3xl p-8 border border-white/50 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-warkop-red/10 rounded-2xl">
                            <i class="bi bi-people text-2xl text-warkop-red"></i>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Total Pelanggan</div>
                            <div class="text-2xl font-black text-gray-900 leading-none">{{ $total_pelanggan }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm rounded-3xl p-8 border border-white/50 shadow-lg">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-gray-900 flex items-center gap-2">
                        <i class="bi bi-clock-history text-warkop-red"></i>
                        Reservasi Terbaru
                    </h3>
                    <a href="{{ route('admin.reservasis') }}" class="text-sm font-bold text-warkop-red hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Meja</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-100">
                            @foreach($recent_reservasis as $res)
                            <tr class="hover:bg-white transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">{{ $res->user->name }}</div>
                                    <div class="text-xs text-gray-500 font-medium">WA: {{ $res->whatsapp }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-700">{{ $res->meja->nama_meja }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $res->tanggal->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClass = $res->status == 'valid' ? 'bg-green-100 text-green-800' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800');
                                        $statusLabel = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
                                    @endphp
                                    <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
