<x-app-layout>
    <div class="bg-white/90 backdrop-blur-xl border border-white/60 rounded-3xl shadow-2xl shadow-blue-100/80 p-8 space-y-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-blue-500 font-semibold">Monitoring</p>
                <h1 class="text-3xl font-bold text-slate-900">Hasil Pendaftaran Beasiswa</h1>
                <p class="text-sm text-slate-500 mt-1">Pantau status pengajuan mahasiswa dengan tampilan modern dan responsif.</p>
            </div>
            <a href="{{ route('pendaftaran.create') }}"
               class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:shadow-xl hover:scale-[1.01] transition-all duration-200">
                Tambah Pendaftar
            </a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-white shadow-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm bg-white/80">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 uppercase text-xs tracking-widest">
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">No HP</th>
                            <th class="px-4 py-3">Semester</th>
                            <th class="px-4 py-3">IPK</th>
                            <th class="px-4 py-3">Jenis Beasiswa</th>
                            <th class="px-4 py-3">Status Ajuan</th>
                            <th class="px-4 py-3 text-center">Berkas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($pendaftarans as $pendaftaran)
                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="px-4 py-4 font-semibold text-slate-900">{{ $pendaftaran->nama }}</td>
                                <td class="px-4 py-4 text-slate-500">{{ $pendaftaran->email }}</td>
                                <td class="px-4 py-4 text-slate-500">{{ $pendaftaran->no_hp }}</td>
                                <td class="px-4 py-4 text-slate-500">{{ $pendaftaran->semester }}</td>
                                <td class="px-4 py-4 text-slate-700 font-semibold">{{ number_format($pendaftaran->ipk, 2) }}</td>
                                <td class="px-4 py-4 text-slate-700">
                                    {{ $pendaftaran->jenisBeasiswa?->nama ?? '-' }}
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $pendaftaran->status_ajuan === 'terverifikasi' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                        {{ ucwords($pendaftaran->status_ajuan) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @if ($pendaftaran->file_path)
                                        <a href="{{ asset('storage/'.$pendaftaran->file_path) }}"
                                           target="_blank"
                                           class="inline-flex items-center gap-1 text-blue-600 font-semibold hover:underline">
                                            Lihat
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 4.5H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5A2.25 2.25 0 0 0 6.75 19.5h10.5a2.25 2.25 0 0 0 2.25-2.25V11.25M21 3l-9.75 9.75M21 3h-6M21 3v6"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-slate-500">
                                    Belum ada pendaftaran yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
