<x-app-layout>
    <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-wide text-blue-500 font-semibold">Monitoring</p>
                <h1 class="text-2xl font-bold text-gray-900">Hasil Pendaftaran Beasiswa</h1>
                <p class="text-sm text-gray-500 mt-1">Pantau status pengajuan mahasiswa yang masuk.</p>
            </div>
            <a href="{{ route('pendaftaran.create') }}"
               class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold rounded-full bg-blue-600 text-white hover:bg-blue-700 transition shadow">
                Tambah Pendaftar
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="bg-blue-50 text-blue-600 uppercase text-xs tracking-wide">
                        <th class="px-4 py-3 rounded-l-lg">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">No HP</th>
                        <th class="px-4 py-3">Semester</th>
                        <th class="px-4 py-3">IPK</th>
                        <th class="px-4 py-3">Jenis Beasiswa</th>
                        <th class="px-4 py-3">Status Ajuan</th>
                        <th class="px-4 py-3 rounded-r-lg text-center">Berkas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pendaftarans as $pendaftaran)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 font-semibold text-gray-800">{{ $pendaftaran->nama }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $pendaftaran->email }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $pendaftaran->no_hp }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $pendaftaran->semester }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ number_format($pendaftaran->ipk, 2) }}</td>
                            <td class="px-4 py-4 text-gray-700">
                                {{ $pendaftaran->jenisBeasiswa?->nama ?? '-' }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    {{ ucwords($pendaftaran->status_ajuan) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                @if ($pendaftaran->file_path)
                                    <a href="{{ asset('storage/'.$pendaftaran->file_path) }}"
                                       target="_blank"
                                       class="text-blue-600 font-semibold hover:underline">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">Tidak ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                Belum ada pendaftaran yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
