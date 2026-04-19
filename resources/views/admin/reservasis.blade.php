<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 tracking-tight">
            {{ __('Kelola Reservasi') }} <span class="text-warkop-red">- Warkop Pamulang</span>
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 flex justify-between items-end" data-aos="fade-right">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        {{ __('Daftar Reservasi') }}
                    </h2>
                    <p class="text-gray-500 mt-1">Tinjau dan verifikasi pesanan meja pelanggan.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-xl rounded-3xl border border-white/50 p-8">
                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Detail Pelanggan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Info Meja & Menu</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jadwal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status Pembayaran</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status Reservasi</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-100">
                            @foreach($reservasis as $res)
                            <tr class="hover:bg-white transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">{{ $res->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $res->user->email }}</div>
                                    <div class="text-xs font-bold text-warkop-red mt-1 flex items-center gap-1">
                                        <i class="bi bi-whatsapp"></i> {{ $res->whatsapp }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">{{ $res->meja->nama_meja }}</div>
                                    <div class="text-xs text-gray-500 italic mb-2">Durasi: {{ $res->durasi }} Jam</div>
                                    
                                    <div class="mt-2 border-t border-gray-100 pt-2">
                                        <span class="text-[10px] font-black text-warkop-red uppercase tracking-wider">Pesanan Menu:</span>
                                        <ul class="mt-1 space-y-1">
                                            @foreach($res->detailPesanans as $detail)
                                            <li class="text-xs text-gray-700 flex justify-between">
                                                <span>{{ $detail->menu->nama_menu }}</span>
                                                <span class="font-bold">x{{ $detail->jumlah }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $res->tanggal->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $res->waktu }} WIB</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="text-xs text-gray-500">Total: Rp {{ number_format($res->pembayaran->total_bayar ?? 0, 0, ',', '.') }}</div>
                                        <div class="font-bold text-gray-900">DP: Rp {{ number_format($res->pembayaran->jumlah_dp ?? 0, 0, ',', '.') }}</div>
                                        @if(($res->pembayaran->sisa_bayar ?? 0) > 0)
                                            <div class="text-[10px] font-black text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full mt-1">
                                                BELUM LUNAS: Rp {{ number_format($res->pembayaran->sisa_bayar, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <div class="text-[10px] font-black text-green-600 bg-green-50 px-2 py-0.5 rounded-full mt-1">
                                                LUNAS
                                            </div>
                                        @endif
                                        
                                        @php
                                            $payStatusClass = $res->pembayaran->status == 'valid' ? 'text-green-600' : ($res->pembayaran->status == 'pending' ? 'text-amber-600' : 'text-rose-600');
                                            $payStatusLabel = $res->pembayaran->status == 'valid' ? 'KONFIRMASI VALID' : ($res->pembayaran->status == 'pending' ? 'MENUNGGU DP' : 'DP DITOLAK');
                                        @endphp
                                        <span class="text-[10px] uppercase font-black {{ $payStatusClass }} mt-1">
                                            {{ $payStatusLabel }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClass = $res->status == 'valid' ? 'bg-green-100 text-green-800' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800');
                                        $statusLabel = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        @if($res->status == 'pending')
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('admin.verify', $res->id) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="valid">
                                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md flex items-center gap-1">
                                                    <i class="bi bi-check-lg"></i> Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.verify', $res->id) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-rose-700 transition shadow-sm hover:shadow-md flex items-center gap-1">
                                                    <i class="bi bi-x-lg"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                        @elseif($res->status == 'valid' && ($res->pembayaran->sisa_bayar ?? 0) > 0)
                                            <form action="{{ route('admin.lunas', $res->id) }}" method="POST" class="inline lunas-form">
                                                @csrf
                                                <button type="button" onclick="confirmLunas(this)" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-black hover:bg-blue-700 transition shadow-sm hover:shadow-md flex items-center gap-1">
                                                    <i class="bi bi-cash-stack"></i> Set Lunas
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 font-bold italic text-xs">Selesai</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLunas(button) {
            const form = button.closest('form');
            Swal.fire({
                title: '<h4 class="fw-bold mb-0">Konfirmasi Pelunasan</h4>',
                html: '<p class="text-muted small">Apakah pelanggan sudah membayar sisa tagihan secara tunai/transfer?</p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Sudah Lunas',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4 border-0 shadow-lg',
                    confirmButton: 'btn btn-primary px-4 py-2 rounded-xl text-xs font-bold',
                    cancelButton: 'btn btn-light px-4 py-2 rounded-xl text-xs font-bold'
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
</x-app-layout>
