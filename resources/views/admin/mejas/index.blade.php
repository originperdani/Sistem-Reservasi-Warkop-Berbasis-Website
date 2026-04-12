<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-emerald-800 leading-tight">
                {{ __('Manage Tables') }}
            </h2>
            <button class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-700">
                + Add New Table
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-emerald-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-emerald-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-emerald-100">
                        <thead class="bg-emerald-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Capacity</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-emerald-50">
                            @foreach($mejas as $meja)
                            <tr class="hover:bg-emerald-50/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-emerald-900">{{ $meja->nama_meja }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-emerald-600 font-bold">
                                    {{ $meja->kapasitas }} person
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        {{ $meja->status == 'tersedia' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ ucfirst($meja->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-emerald-600 hover:text-emerald-900 mr-3"><i class="bi bi-pencil"></i></button>
                                    <button class="text-rose-600 hover:text-rose-900"><i class="bi bi-trash"></i></button>
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
