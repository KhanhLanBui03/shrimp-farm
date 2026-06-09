<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50/50">
        <div class="h-screen flex overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Content Area -->
            <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
                <!-- Top Header -->
                <header class="bg-white border-b border-slate-100 px-8 py-4 flex items-center justify-between shrink-0 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Hệ thống giám sát</span>
                        <span class="text-slate-300">|</span>
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-0.5 rounded">Trang trại đang hoạt động</span>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Profile Edit Link -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 text-xs font-bold uppercase tracking-wider text-slate-700 hover:text-slate-950 bg-slate-50 border border-slate-200 px-4 py-2 rounded-lg hover:bg-slate-100 transition-all">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Hồ sơ cá nhân</span>
                        </a>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto bg-slate-50/50 p-8">
                    <!-- Flash Messages & Validation Errors -->
                    @if (session('success') || session('error') || $errors->any())
                        <div class="max-w-7xl mx-auto mb-6">
                            @if (session('success'))
                                <div class="p-4 mb-4 text-sm text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-bold">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-2xl bg-red-50 border border-red-100 flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <span class="font-bold">{{ session('error') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-2xl bg-red-50 border border-red-100">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        <span class="font-bold">Đã xảy ra lỗi nhập liệu:</span>
                                    </div>
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
