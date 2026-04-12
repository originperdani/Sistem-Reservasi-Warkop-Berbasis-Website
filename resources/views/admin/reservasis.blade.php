<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-emerald-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl mb-6 relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-emerald-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-emerald-100">
                        <thead class="bg-emerald-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">User</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Table</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">DP Amount</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-emerald-50">
                            @foreach($reservasis as $res)
                            <tr class="hover:bg-emerald-50/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-emerald-900">{{ $res->user->name }}</div>
                                    <div class="text-xs text-emerald-600">{{ $res->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-emerald-800">{{ $res->meja->nama_meja }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-emerald-600">{{ $res->tanggal }} {{ $res->waktu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-emerald-700">Rp {{ number_format($res->pembayaran->jumlah_dp ?? 0, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                        {{ $res->status == 'valid' ? 'bg-emerald-100 text-emerald-800' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                                        {{ ucfirst($res->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($res->status == 'pending')
                                    <form action="{{ route('admin.verify', $res->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="valid">
                                        <button type="submit" class="bg-emerald-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-emerald-700 transition mr-2">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.verify', $res->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="bg-rose-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-rose-700 transition">Reject</button>
                                    </form>
                                    @else
                                        <span class="text-gray-400">Processed</span>
                                    @endif
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
