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
    <body x-data="{ showLogoutConfirm: false }" class="font-sans antialiased bg-slate-50/50">
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

                <main class="flex-1 overflow-y-auto overflow-x-hidden bg-slate-50/50 p-8">
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
        <!-- Beautiful Logout Confirm Modal Overlay -->
        <div x-show="showLogoutConfirm" 
             class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <!-- Modal Content Container -->
            <div @click.away="showLogoutConfirm = false" 
                 class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-slate-100 transform transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Warning Icon & Title -->
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-2.5 bg-rose-50 text-rose-500 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Xác nhận đăng xuất</h3>
                </div>
                
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                    Bạn có chắc chắn muốn đăng xuất khỏi hệ thống quản lý **AquaControl** không?
                </p>
                
                <!-- Actions Buttons -->
                <div class="flex space-x-3 justify-end">
                    <button @click="showLogoutConfirm = false" 
                            type="button" 
                            class="px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg transition-all">
                        Hủy bỏ
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 text-xs font-bold uppercase tracking-wider text-white bg-rose-500 hover:bg-rose-600 rounded-lg hover:shadow-lg hover:shadow-rose-500/20 transition-all">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
