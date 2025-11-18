@php
    $eligible = $ipk >= 3;
@endphp

<x-app-layout>
    <div
        x-data="{ disableField: {{ $eligible ? 'false' : 'true' }} }"
        x-init="if (!disableField) { $nextTick(() => $refs.jenis.focus()); }"
        class="bg-white/90 backdrop-blur-xl border border-white/70 rounded-3xl shadow-2xl shadow-blue-100/80 p-8 space-y-8"
    >
        <div class="space-y-3">
            <p class="text-xs uppercase tracking-[0.4em] text-blue-500 font-semibold">Formulir Resmi</p>
            <h1 class="text-3xl font-bold text-slate-900">Pendaftaran Beasiswa</h1>
            <p class="text-sm text-slate-500 max-w-2xl">
                Pastikan data sesuai dengan catatan akademik kampus. Sistem akan menentukan IPK secara otomatis untuk menjaga keabsahan data.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-white border border-red-100 text-red-600 text-sm rounded-2xl p-4 space-y-1 shadow-sm">
                <p class="font-semibold">Periksa kembali form:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (! $eligible)
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 text-amber-800 text-sm rounded-2xl p-4 shadow-sm">
                IPK Anda ({{ number_format($ipk, 2) }}) belum memenuhi syarat minimal untuk mendaftar beasiswa.
                Pilihan jenis beasiswa, upload berkas, dan tombol daftar otomatis dinonaktifkan.
            </div>
        @else
            <div class="bg-gradient-to-r from-emerald-50 to-blue-50 border border-emerald-100 text-emerald-700 text-sm rounded-2xl p-4 shadow-sm">
                IPK Anda memenuhi syarat. Silakan pilih jenis beasiswa dan lengkapi berkas yang diperlukan. Jika IPK memenuhi syarat minimal beasiswa yang dipilih, status akan otomatis terverifikasi.
            </div>
        @endif

        <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="ipk" value="{{ $ipk }}">

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           required
                           class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white/80"
                           placeholder="Contoh: Nadya Larasati">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Email Kampus</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           required
                           class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white/80"
                           placeholder="nama@student.ac.id">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                           required inputmode="numeric" pattern="[0-9]+"
                           class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white/80"
                           placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Semester</label>
                    <select name="semester" class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white/80" required>
                        <option value="">Pilih Semester</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ (string) old('semester') === (string) $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">IPK (ditentukan sistem)</label>
                    <input type="text" value="{{ number_format($ipk, 2) }}" readonly
                           class="w-full rounded-2xl border-transparent bg-slate-50 text-slate-700 font-semibold shadow-inner">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Jenis Beasiswa</label>
                    <select name="jenis_beasiswa_id"
                            x-ref="jenis"
                            x-bind:disabled="disableField"
                            class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 disabled:bg-gray-100 disabled:text-gray-400 bg-white/80">
                        <option value="">Pilih Jenis Beasiswa</option>
                        @foreach ($jenisBeasiswa as $jenis)
                            <option value="{{ $jenis->id }}" {{ (string) old('jenis_beasiswa_id') === (string) $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama }} (IPK ≥ {{ number_format($jenis->minimal_ipk, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-600">Upload Dokumen (PDF/JPG/ZIP)</label>
                <input type="file" name="dokumen" accept=".pdf,.jpg,.zip"
                       x-bind:disabled="disableField"
                       class="w-full rounded-2xl border-dashed border-2 border-blue-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white/50 disabled:bg-gray-100 disabled:text-gray-400">
                <p class="text-xs text-gray-500 mt-1">Maksimal 2MB.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        x-bind:disabled="disableField"
                        class="px-8 py-3 rounded-2xl font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:shadow-xl hover:scale-[1.01] disabled:bg-gray-300 disabled:text-gray-500 transition-all shadow-lg">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
