<x-app-layout>
    <div class="bg-white/80 backdrop-blur-xl border border-white/60 rounded-3xl shadow-2xl shadow-blue-100/70 p-8 space-y-8">
        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <span class="inline-flex px-3 py-1 text-xs tracking-[0.3em] uppercase bg-blue-50 text-blue-600 rounded-full font-semibold">Program Unggulan</span>
                <h1 class="text-3xl font-bold text-slate-900">Jenis Beasiswa Kampus</h1>
                <p class="text-base text-slate-500 max-w-2xl">
                    Temukan kesempatan terbaik sesuai performa akademik maupun non akademik. Semua beasiswa kini dapat diakses melalui sistem online yang responsif.
                </p>
            </div>
            <a href="{{ route('pendaftaran.create') }}"
               class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:shadow-xl hover:scale-[1.01] transition-all duration-200">
                Daftar Sekarang
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($jenisBeasiswa as $jenis)
                <div class="p-5 rounded-2xl border border-slate-100 bg-white/80 shadow-sm hover:shadow-xl transition duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-400 font-semibold">Jenis Beasiswa</p>
                            <h2 class="text-xl font-semibold text-slate-900 mt-1">{{ $jenis->nama }}</h2>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Aktif</span>
                    </div>
                    <div class="mt-4 text-sm text-slate-500 leading-relaxed">
                        IPK Minimum
                        <span class="text-2xl font-bold text-blue-600 ml-1">{{ number_format($jenis->minimal_ipk, 2) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($jenisBeasiswa->isEmpty())
            <div class="text-center text-slate-500 text-sm">
                Belum ada data jenis beasiswa.
            </div>
        @endif
    </div>
</x-app-layout>
