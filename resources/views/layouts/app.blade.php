<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Pendaftaran Beasiswa Online') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased text-gray-800 bg-gradient-to-br from-slate-100 via-white to-blue-50 min-h-screen relative">
    <div class="pointer-events-none select-none absolute inset-0 overflow-hidden">
        <div class="absolute top-[-4rem] left-[-2rem] w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply blur-3xl opacity-30"></div>
        <div class="absolute bottom-[-6rem] right-[-3rem] w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply blur-3xl opacity-30"></div>
    </div>

    <nav class="relative bg-white/70 backdrop-blur-lg border-b border-white/50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                    SB
                </div>
                <div>
                    <p class="text-xs uppercase tracking-widest text-blue-500 font-semibold">Sistem Online</p>
                    <a href="{{ route('jenis.beasiswa') }}" class="text-2xl font-semibold tracking-tight text-slate-900">
                        Pendaftaran Beasiswa
                    </a>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 text-sm font-medium">
                <a href="{{ route('jenis.beasiswa') }}"
                   class="px-4 py-2 rounded-full transition shadow {{ request()->routeIs('jenis.beasiswa') ? 'bg-blue-600 text-white' : 'bg-white/70 text-blue-700 hover:bg-blue-50' }}">
                    Jenis Beasiswa
                </a>
                <a href="{{ route('pendaftaran.create') }}"
                   class="px-4 py-2 rounded-full transition shadow {{ request()->routeIs('pendaftaran.create') ? 'bg-blue-600 text-white' : 'bg-white/70 text-blue-700 hover:bg-blue-50' }}">
                    Formulir Pendaftaran
                </a>
                <a href="{{ route('hasil.pendaftaran') }}"
                   class="px-4 py-2 rounded-full transition shadow {{ request()->routeIs('hasil.pendaftaran') ? 'bg-blue-600 text-white' : 'bg-white/70 text-blue-700 hover:bg-blue-50' }}">
                    Hasil Pendaftaran
                </a>
            </div>
        </div>
    </nav>

    <main class="relative py-12 px-4">
        <div class="max-w-5xl mx-auto space-y-6">
            @if (session('success'))
                <div class="bg-white/80 backdrop-blur border border-green-100 text-green-700 rounded-2xl px-5 py-4 text-sm shadow-2xl shadow-green-100/60">
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>
</body>
</html>
