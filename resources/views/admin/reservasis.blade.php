<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900 mb-2">Kelola Reservasi</h1>
        <p class="text-gray-500 font-medium">Tinjau dan verifikasi pesanan meja serta pembayaran pelanggan.</p>
    </x-slot>

    @if(session('success'))
        <div class="glass-card bg-emerald-50 border-emerald-100 text-emerald-700 px-6 py-4 mb-8 flex items-center gap-3 animate-fade-in" data-aos="fade-up">
            <div class="w-9 h-9 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                <i class="bi bi-check-lg"></i>
            </div>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-4" data-aos="fade-up">
        @foreach($reservasis as $res)
        @php
            $statusClass = $res->status == 'valid' ? 'bg-green-100 text-green-700' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700');
            $statusLabel = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
            $statusDot = $res->status == 'valid' ? 'bg-green-500' : ($res->status == 'pending' ? 'bg-amber-500' : 'bg-rose-500');
        @endphp
        <div class="glass-card premium-shadow overflow-hidden hover:shadow-lg transition-all duration-300">
            <div class="flex items-stretch">
                {{-- Left accent --}}
                <div class="w-1.5 {{ $res->status == 'valid' ? 'bg-green-500' : ($res->status == 'pending' ? 'bg-warkop-red' : 'bg-gray-300') }} flex-shrink-0"></div>

                <div class="flex-1 p-5">
                    {{-- Top Row: Customer + Status + Date --}}
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($res->user->name) }}&background=9B1B30&color=fff&size=80" 
                                 class="w-9 h-9 rounded-xl shadow-sm">
                            <div>
                                <span class="font-bold text-gray-900 text-sm">{{ $res->user->name }}</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $res->whatsapp) }}" 
                                   target="_blank"
                                   class="flex items-center gap-1 text-[11px] font-bold text-green-600 hover:text-green-700 transition-colors mt-0.5">
                                    <i class="bi bi-whatsapp"></i> {{ $res->whatsapp }}
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <div class="text-xs font-bold text-gray-800">{{ $res->tanggal->format('d M Y') }}</div>
                                <div class="text-[10px] font-bold text-gray-400">{{ $res->waktu }} WIB · {{ $res->durasi }} Jam</div>
                            </div>
                            <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-black rounded-full uppercase tracking-wider {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>

                    {{-- Bottom Row: Meja + Menu + Payment + Action --}}
                    <div class="flex items-center justify-between bg-gray-50/80 rounded-xl px-4 py-3">
                        <div class="flex items-center gap-5">
                            {{-- Meja --}}
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-warkop-red/10 rounded-lg flex items-center justify-center">
                                    <i class="bi bi-grid-1x2 text-warkop-red text-xs"></i>
                                </div>
                                <span class="text-xs font-bold text-gray-800">{{ $res->meja->nama_meja }}</span>
                            </div>

                            {{-- Divider --}}
                            <div class="w-px h-5 bg-gray-200"></div>

                            {{-- Menu Items --}}
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <i class="bi bi-cup-straw text-gray-400 text-xs"></i>
                                @foreach($res->detailPesanans->take(3) as $detail)
                                <span class="px-2 py-0.5 bg-white text-gray-600 text-[10px] font-bold rounded-md border border-gray-150">
                                    {{ $detail->menu->nama_menu }} ×{{ $detail->jumlah }}
                                </span>
                                @endforeach
                                @if($res->detailPesanans->count() > 3)
                                <span class="text-[10px] font-bold text-gray-400">+{{ $res->detailPesanans->count() - 3 }} lagi</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            {{-- Payment --}}
                            <div class="text-right">
                                <div class="text-xs font-black text-gray-900">Rp {{ number_format($res->pembayaran->total_bayar ?? 0, 0, ',', '.') }}</div>
                                @if(($res->pembayaran->sisa_bayar ?? 0) > 0)
                                    <div class="text-[10px] font-bold text-rose-500">Sisa: Rp {{ number_format($res->pembayaran->sisa_bayar, 0, ',', '.') }}</div>
                                @else
                                    <div class="text-[10px] font-bold text-emerald-500">Lunas</div>
                                @endif
                            </div>

                            {{-- Divider --}}
                            <div class="w-px h-8 bg-gray-200"></div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-2">
                                @if($res->status == 'pending')
                                    <form action="{{ route('admin.verify', $res->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="valid">
                                        <button type="submit" class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center hover:bg-emerald-600 transition-all shadow-sm text-sm" title="Terima">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.verify', $res->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="w-8 h-8 bg-rose-500 text-white rounded-lg flex items-center justify-center hover:bg-rose-600 transition-all shadow-sm text-sm" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                @elseif($res->status == 'valid' && ($res->pembayaran->sisa_bayar ?? 0) > 0)
                                    <form action="{{ route('admin.lunas', $res->id) }}" method="POST">
                                        @csrf
                                        <button type="button" onclick="confirmLunas(this)" class="px-4 py-1.5 bg-warkop-red text-white text-[10px] font-black rounded-lg hover:bg-warkop-red-dark transition-all shadow-sm uppercase tracking-wider">
                                            Set Lunas
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-300 text-[10px] font-bold italic uppercase tracking-wider">Selesai</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLunas(button) {
            const form = button.closest('form');
            Swal.fire({
                title: '<h4 class="font-bold text-gray-900">Konfirmasi Pelunasan</h4>',
                html: '<p class="text-gray-500 text-sm">Apakah pelanggan sudah membayar sisa tagihan secara tunai/transfer?</p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9B1B30',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Sudah Lunas',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2rem] border-0 shadow-2xl p-10',
                    confirmButton: 'px-8 py-3 rounded-2xl font-bold text-white',
                    cancelButton: 'px-8 py-3 rounded-2xl font-bold text-gray-500 bg-gray-100 ml-4'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
