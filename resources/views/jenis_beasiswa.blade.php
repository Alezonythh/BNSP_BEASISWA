<x-app-layout>
    <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-wide text-blue-500 font-semibold">Informasi Program</p>
                <h1 class="text-2xl font-bold text-gray-900">Jenis Beasiswa Kampus</h1>
                <p class="text-sm text-gray-500 mt-1">Pilih beasiswa sesuai IPK dan pencapaianmu.</p>
            </div>
            <a href="{{ route('pendaftaran.create') }}"
               class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold rounded-full bg-blue-600 text-white hover:bg-blue-700 transition shadow">
                Daftar Sekarang
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="bg-blue-50 text-blue-600 uppercase text-xs tracking-wide">
                        <th class="px-4 py-3 rounded-l-lg">Nama Beasiswa</th>
                        <th class="px-4 py-3 rounded-r-lg">IPK Minimum</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($jenisBeasiswa as $jenis)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 font-semibold text-gray-800">{{ $jenis->nama }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ number_format($jenis->minimal_ipk, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-4 py-4 text-center text-gray-500">
                                Belum ada data jenis beasiswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
