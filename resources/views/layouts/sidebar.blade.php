<aside x-data="{ showLogoutConfirm: false }" class="w-64 bg-slate-900 text-slate-300 h-screen flex flex-col justify-between border-r border-slate-800 shadow-xl select-none shrink-0 sticky top-0">
    <!-- Brand / Header -->
    <div class="p-6 border-b border-slate-800/60 bg-slate-950/30">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-emerald-500/10 text-emerald-400 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-md font-black text-white uppercase tracking-wider">AquaControl</h1>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-0.5">Shrimp Farm Management</p>
            </div>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto sidebar-scroll px-4 py-6 space-y-6">
        <!-- HỆ THỐNG -->
        <div>
            <h3 class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Hệ Thống</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('users.index') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Tài khoản & Phân quyền</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('audit-logs.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('audit-logs.index') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Nhật ký hoạt động</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- CƠ SỞ HẠ TẦNG -->
        <div>
            <h3 class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Cơ Sở Hạ Tầng</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('farming-zones.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('farming-zones.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>Quản lý khu nuôi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ponds.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('ponds.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                        <span>Quản lý ao nuôi</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- VỤ NUÔI & SẢN XUẤT -->
        <div>
            <h3 class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Vụ Nuôi & Sản Xuất</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('cultivation-cycles.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('cultivation-cycles.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 6H16"></path>
                        </svg>
                        <span>Quản lý vụ nuôi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seed-batches.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('seed-batches.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Quản lý thả giống</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('technical-logs.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('technical-logs.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Nhật ký kỹ thuật ao</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('water-quality-logs.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('water-quality-logs.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span>Quản lý chỉ số nước</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- THỨC ĂN & VẬT TƯ -->
        <div>
            <h3 class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Thức Ăn & Vật Tư</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('materials.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('materials.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span>Vật tư & Kho</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('suppliers.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('suppliers.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Nhà cung cấp</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- TÀI CHÍNH & TIÊU THỤ -->
        <div>
            <h3 class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Tài Chính & Thu Hoạch</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('harvests.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('harvests.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Quản lý thu hoạch</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sales-invoices.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('sales-invoices.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0h6"></path>
                        </svg>
                        <span>Quản lý bán hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customers.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('customers.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Quản lý khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('operating-expenses.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-semibold rounded-lg transition-all {{ request()->routeIs('operating-expenses.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'hover:bg-slate-800/50 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Chi phí vận hành</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- User Profile & Footer Info -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/20">
        <div class="bg-slate-850/40 border border-slate-800/40 p-3.5 rounded-xl flex items-center justify-between">
            <div class="flex flex-col min-w-0">
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

    <!-- Beautiful Logout Confirm Modal Overlay -->
    <div x-show="showLogoutConfirm" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
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
</aside>
