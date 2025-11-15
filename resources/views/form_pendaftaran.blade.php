@php
    $eligible = $ipk >= 3;
@endphp

<x-app-layout>
    <div
        x-data="{ disableField: {{ $eligible ? 'false' : 'true' }} }"
        x-init="if (!disableField) { $nextTick(() => $refs.jenis.focus()); }"
        class="bg-white rounded-lg shadow-lg p-6 space-y-6"
    >
        <div>
            <p class="text-sm uppercase tracking-wide text-blue-500 font-semibold">Formulir Resmi</p>
            <h1 class="text-2xl font-bold text-gray-900">Pendaftaran Beasiswa</h1>
            <p class="text-sm text-gray-500 mt-1">
                Pastikan data yang diisi sesuai dengan data akademik kampus.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-4 space-y-1">
                <p class="font-semibold">Periksa kembali form:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (! $eligible)
            <div class="bg-amber-50 border border-amber-200 text-amber-800 text-sm rounded-lg p-4">
                IPK Anda ({{ number_format($ipk, 2) }}) belum memenuhi syarat minimal untuk mendaftar beasiswa.
                Pilihan jenis beasiswa, upload berkas, dan tombol daftar otomatis dinonaktifkan.
            </div>
        @else
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg p-4">
                IPK Anda memenuhi syarat. Silakan pilih jenis beasiswa dan lengkapi berkas yang diperlukan. Jika IPK memenuhi syarat minimal beasiswa yang dipilih, status akan otomatis terverifikasi.
            </div>
        @endif

        <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="ipk" value="{{ $ipk }}">

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           required
                           class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Contoh: Nadya Larasati">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email Kampus</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           required
                           class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="nama@student.ac.id">
                </div>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                           required inputmode="numeric" pattern="[0-9]+"
                           class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500"
                           placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                    <select name="semester" class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">Pilih Semester</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ (string) old('semester') === (string) $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">IPK (ditentukan sistem)</label>
                    <input type="text" value="{{ number_format($ipk, 2) }}" readonly
                           class="w-full rounded-lg border-gray-200 bg-gray-50 text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Beasiswa</label>
                    <select name="jenis_beasiswa_id"
                            x-ref="jenis"
                            x-bind:disabled="disableField"
                            class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-400">
                        <option value="">Pilih Jenis Beasiswa</option>
                        @foreach ($jenisBeasiswa as $jenis)
                            <option value="{{ $jenis->id }}" {{ (string) old('jenis_beasiswa_id') === (string) $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama }} (IPK ≥ {{ number_format($jenis->minimal_ipk, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Dokumen (PDF/JPG/ZIP)</label>
                <input type="file" name="dokumen" accept=".pdf,.jpg,.zip"
                       x-bind:disabled="disableField"
                       class="w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-400">
                <p class="text-xs text-gray-500 mt-1">Maksimal 2MB.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        x-bind:disabled="disableField"
                        class="px-6 py-3 rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:text-gray-500 transition shadow">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
