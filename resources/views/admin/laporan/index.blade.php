<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-black text-gray-900 mb-2">Laporan Reservasi</h1>
                <p class="text-gray-500 font-medium">Analisis data reservasi dan pendapatan warkop.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.laporan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
                   class="flex items-center gap-2 px-6 py-3 bg-warkop-red text-white rounded-2xl font-bold hover:bg-warkop-red-dark transition-all shadow-sm">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Export PDF
                </a>
                <a href="{{ route('admin.laporan.excel', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
                   class="flex items-center gap-2 px-6 py-3 bg-gray-700 text-white rounded-2xl font-bold hover:bg-gray-800 transition-all shadow-sm">
                    <i class="bi bi-file-earmark-excel"></i>
                    Export Excel
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Filters -->
    <div class="glass-card p-8 mb-10 premium-shadow">
        <form action="{{ route('admin.laporan') }}" method="GET" class="flex flex-wrap items-end gap-6">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-bold text-gray-700 mb-3">Pilih Bulan</label>
                <select name="bulan" class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-premium-gold/20 font-medium">
                    <option value="all" {{ $bulan == 'all' ? 'selected' : '' }}>Semua Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ sprintf('%02d', $i) }}" {{ $bulan == sprintf('%02d', $i) ? 'selected' : '' }}>
                            {{ Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-bold text-gray-700 mb-3">Pilih Tahun</label>
                <select name="tahun" class="w-full px-5 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-premium-gold/20 font-medium">
                    @for($i = date('Y'); $i >= date('Y')-5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="px-8 py-3 bg-warkop-red text-white rounded-xl font-bold hover:bg-warkop-red-dark transition-all shadow-lg shadow-warkop-red/20">
                <i class="bi bi-filter me-2"></i> Tampilkan
            </button>
        </form>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="glass-card p-8 premium-shadow border-l-4 border-warkop-red">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-warkop-red/10 rounded-2xl text-warkop-red">
                    <i class="bi bi-graph-up-arrow text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-gray-900">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-8 premium-shadow border-l-4 border-warkop-red">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-warkop-red/10 rounded-2xl text-warkop-red">
                    <i class="bi bi-bookmark-check-fill text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Reservasi</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $laporan->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-8 premium-shadow border-l-4 border-warkop-red">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-warkop-red/10 rounded-2xl text-warkop-red">
                    <i class="bi bi-patch-check-fill text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Reservasi Selesai</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $laporan->where('status', 'valid')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="glass-card overflow-hidden premium-shadow">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Meja</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Tanggal & Waktu</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-right">Total Bayar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($laporan as $res)
                    <tr class="hover:bg-premium-bg/50 transition-colors">
                        <td class="px-8 py-5">
                            <div class="font-bold text-gray-900">{{ $res->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $res->user->email }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 bg-warkop-red/5 text-warkop-red text-xs font-bold rounded-lg border border-warkop-red/10">
                                {{ $res->meja->nama_meja }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-sm font-semibold text-gray-700">{{ $res->tanggal->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $res->waktu }} WIB</div>
                        </td>
                        <td class="px-8 py-5">
                            @php
                                $statusClass = $res->status == 'valid' ? 'bg-green-100 text-green-700' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700');
                                $statusLabel = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
                            @endphp
                            <span class="px-4 py-1.5 inline-flex text-[10px] leading-5 font-black rounded-full uppercase tracking-wider {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right font-bold text-gray-900">
                            Rp {{ number_format($res->pembayaran ? $res->pembayaran->total_bayar : 0, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <i class="bi bi-inbox text-5xl text-gray-200 mb-4"></i>
                                <p class="text-gray-400 font-medium">Tidak ada data reservasi untuk periode ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
