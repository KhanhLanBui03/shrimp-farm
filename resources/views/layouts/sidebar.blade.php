<aside :class="sidebarCollapsed ? 'w-20' : 'w-64'" 
       class="bg-slate-900 text-slate-300 h-screen flex flex-col justify-between border-r border-slate-800 shadow-xl select-none shrink-0 sticky top-0 transition-all duration-300 ease-in-out">
    <!-- Brand / Header -->
    <div class="p-4 border-b border-slate-800/60 bg-slate-950/30">
        <div class="flex items-center justify-between" :class="sidebarCollapsed ? 'flex-col space-y-3' : 'flex-row'">
            <div class="flex items-center" :class="sidebarCollapsed ? 'flex-col space-y-2' : 'space-x-2.5'">
                <div class="p-2 bg-gradient-to-br from-emerald-500/10 to-cyan-500/10 text-emerald-400 rounded-xl border border-emerald-500/20 shadow-inner flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="shrimp-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#34d399" />
                                <stop offset="50%" stop-color="#22d3ee" />
                                <stop offset="100%" stop-color="#60a5fa" />
                            </linearGradient>
                        </defs>
                        <!-- Outer spine / shrimp silhouette -->
                        <path d="M6 22C6 14.5 11.5 8 18.5 8C23.5 8 26.5 11 28 14.5" stroke="url(#shrimp-grad)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        <!-- Inner segment / water flow -->
                        <path d="M9 24C11.5 21.5 13.5 19 13.5 16C13.5 13 16 11 19 11C21.5 11 23 12.5 24 14" stroke="url(#shrimp-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" opacity="0.85" />
                        <!-- Tail -->
                        <path d="M4 25C5.5 24.5 6 23 5.5 21.5C5 20 6.5 19.5 7.5 20.5" stroke="url(#shrimp-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <!-- Antennae representing wireless connectivity / IoT -->
                        <path d="M28 14.5C29.5 13.5 31 13 32 13" stroke="url(#shrimp-grad)" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M27 12C28.5 9.5 30 8 31 7" stroke="url(#shrimp-grad)" stroke-width="1.5" stroke-linecap="round" opacity="0.75" />
                        <!-- Wave ripple -->
                        <path d="M10 27C14 28.5 18 28.5 22 27" stroke="url(#shrimp-grad)" stroke-width="1.5" stroke-linecap="round" opacity="0.6" />
                        <!-- Smart tech connection points -->
                        <circle cx="18.5" cy="8" r="1.5" fill="#34d399" />
                        <circle cx="28" cy="14.5" r="1.5" fill="#22d3ee" />
                        <circle cx="13.5" cy="16" r="1.2" fill="#60a5fa" />
                    </svg>
                </div>
                <div x-show="!sidebarCollapsed" x-transition class="transition-all duration-200">
                    <h1 class="text-sm font-black text-white uppercase tracking-wider">AquaControl</h1>
                    <p class="text-[9px] text-slate-500 uppercase tracking-widest font-semibold mt-0.5">Management</p>
                </div>
            </div>
            <!-- Toggle Button -->
            <button @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('sidebarCollapsed', sidebarCollapsed)" 
                    class="p-1.5 hover:bg-slate-800 rounded-lg text-slate-400 hover:text-white transition-colors focus:outline-none flex items-center justify-center"
                    :class="sidebarCollapsed ? 'mt-2' : ''">
                <svg x-show="!sidebarCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h12m-12 6h16M16 8l-4 4 4 4"></path>
                </svg>
                <svg x-show="sidebarCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h12m-12 6h16M12 8l4 4-4 4"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Navigation Links -->
    <div :class="sidebarCollapsed ? 'overflow-visible' : 'overflow-y-auto sidebar-scroll'" class="flex-1 px-4 py-6 space-y-6">
        <!-- HỆ THỐNG -->
        <div>
            <h3 x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Hệ Thống</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                       :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        <span x-show="!sidebarCollapsed">Dashboard</span>
                        <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                            Dashboard
                        </span>
                    </a>
                </li>
                @if(Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('owner'))
                    <li>
                        <a href="{{ route('users.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('users.index') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Tài khoản & Phân quyền</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Tài khoản & Phân quyền
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('audit-logs.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('audit-logs.index') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Nhật ký hoạt động</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Nhật ký hoạt động
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- CƠ SỞ HẠ TẦNG -->
        @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('technician'))
            <div>
                <h3 x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Cơ Sở Hạ Tầng</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('farming-zones.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('farming-zones.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Quản lý khu nuôi</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Quản lý khu nuôi
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ponds.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('ponds.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Quản lý ao nuôi</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Quản lý ao nuôi
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        <!-- VỤ NUÔI & SẢN XUẤT -->
        @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('technician') || Auth::user()->hasRole('accountant'))
            <div>
                <h3 x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Vụ Nuôi & Sản Xuất</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('cultivation-cycles.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('cultivation-cycles.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 6H16"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Quản lý vụ nuôi</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Quản lý vụ nuôi
                            </span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('technician'))
                        <li>
                            <a href="{{ route('seed-batches.index') }}" 
                               class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('seed-batches.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                               :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                                <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed">Quản lý thả giống</span>
                                <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                    Quản lý thả giống
                                </span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('technical-logs.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('technical-logs.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Nhật ký kỹ thuật ao</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Nhật ký kỹ thuật ao
                            </span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('technician'))
                        <li>
                            <a href="{{ route('water-quality-logs.index') }}" 
                               class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('water-quality-logs.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                               :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                                <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed">Quản lý chỉ số nước</span>
                                <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                    Quản lý chỉ số nước
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif

        <!-- THỨC ĂN & VẬT TƯ -->
        @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('warehouse_staff') || Auth::user()->hasRole('technician') || Auth::user()->hasRole('accountant'))
            <div>
                <h3 x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Thức Ăn & Vật Tư</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('materials.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('materials.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Vật tư & Kho</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Vật tư & Kho
                            </span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('warehouse_staff') || Auth::user()->hasRole('accountant'))
                        <li>
                            <a href="{{ route('suppliers.index') }}" 
                               class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('suppliers.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                               :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                                <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed">Nhà cung cấp</span>
                                <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                    Nhà cung cấp
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif

        <!-- TÀI CHÍNH & TIÊU THỤ -->
        @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('harvester') || Auth::user()->hasRole('accountant') || Auth::user()->hasRole('technician'))
            <div>
                <h3 x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Tài Chính & Thu Hoạch</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('harvests.index') }}" 
                           class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('harvests.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                            <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <span x-show="!sidebarCollapsed">Quản lý thu hoạch</span>
                            <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                Quản lý thu hoạch
                            </span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('accountant'))
                        <li>
                            <a href="{{ route('sales-invoices.index') }}" 
                               class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('sales-invoices.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                               :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                                <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0h6"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed">Quản lý bán hàng</span>
                                <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                    Quản lý bán hàng
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.index') }}" 
                               class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('customers.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                               :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                                <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed">Quản lý khách hàng</span>
                                <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                    Quản lý khách hàng
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operating-expenses.index') }}" 
                               class="relative group flex items-center px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('operating-expenses.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}"
                               :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                                <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed">Chi phí vận hành</span>
                                <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2.5 py-1.5 bg-slate-950/95 text-slate-200 text-xs font-semibold rounded-lg opacity-0 scale-90 group-hover:opacity-100 group-hover:scale-100 pointer-events-none transition-all duration-150 origin-left whitespace-nowrap z-50 shadow-xl border border-slate-800/80">
                                    Chi phí vận hành
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <!-- User Profile & Footer Info -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/20">
        <div class="bg-slate-850/40 border border-slate-800/40 p-3.5 rounded-xl flex items-center transition-all duration-300" 
             :class="sidebarCollapsed ? 'flex-col space-y-3 p-2 justify-center' : 'flex-row justify-between'">
            <div x-show="!sidebarCollapsed" class="flex flex-col min-w-0 transition-all duration-300">
                <span class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</span>
                <span class="text-[10px] text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</span>
                <div class="mt-1.5 flex">
                    <span class="px-2 py-0.5 text-[9px] font-black text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 rounded uppercase tracking-wider">
                        {{ Auth::user()->role?->label() ?? 'Nhân Viên' }}
                    </span>
                </div>
            </div>

            <!-- Logout Button (triggers Modal) -->
            <button @click="showLogoutConfirm = true" type="button" title="Đăng xuất" class="p-2 hover:bg-slate-800 text-slate-400 hover:text-rose-400 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </button>
        </div>
    </div>
</aside>
