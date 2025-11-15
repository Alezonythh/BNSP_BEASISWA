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
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('jenis.beasiswa') }}" class="text-2xl font-semibold tracking-wide">
                    Sistem Pendaftaran Beasiswa
                </a>
            </div>
            <div class="flex gap-2 text-sm font-medium">
                <a href="{{ route('jenis.beasiswa') }}"
                   class="px-4 py-2 rounded-full transition {{ request()->routeIs('jenis.beasiswa') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Jenis Beasiswa
                </a>
                <a href="{{ route('pendaftaran.create') }}"
                   class="px-4 py-2 rounded-full transition {{ request()->routeIs('pendaftaran.create') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Formulir Pendaftaran
                </a>
                <a href="{{ route('hasil.pendaftaran') }}"
                   class="px-4 py-2 rounded-full transition {{ request()->routeIs('hasil.pendaftaran') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    Hasil Pendaftaran
                </a>
            </div>
        </div>
    </nav>

    <main class="py-10 px-4">
        <div class="max-w-5xl mx-auto space-y-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 border border-green-200 rounded-lg px-4 py-3 text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>
</body>
</html>
