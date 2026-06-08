<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AquaControl — Hệ thống Quản lý & Vận hành Trang trại Nuôi tôm Doanh nghiệp</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafbfe;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .soft-grid {
            background-size: 30px 30px;
            background-image: linear-gradient(to right, rgba(99, 102, 241, 0.03) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(99, 102, 241, 0.03) 1px, transparent 1px);
        }
        .gradient-text {
            background: linear-gradient(135deg, #0f172a 30%, #16a34a 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glow-effect {
            box-shadow: 0 0 40px -10px rgba(22, 163, 74, 0.12);
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen overflow-x-hidden selection:bg-emerald-500 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- Ambient Glowing Background Elements -->
    <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-emerald-200/20 rounded-full blur-[120px] pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 right-1/4 w-[600px] h-[600px] bg-sky-200/20 rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <!-- Navigation Header -->
    <header class="border-b border-slate-100 bg-white/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-10">
                <!-- Brand Logo -->
                <a href="#" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-sky-500 p-[1.5px] shadow-md shadow-emerald-500/10 transition-transform duration-300 group-hover:scale-105">
                        <div class="w-full h-full bg-white rounded-[10px] flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12c0-3 3-3 3-3s3 3 6 3 6-3 6-3v6s-3 3-6 3-6-3-6-3z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900 uppercase">AquaControl</span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#monitoring" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Vận hành</a>
                    <a href="#water" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Chỉ số nước</a>
                    <a href="#feeding" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Cho ăn</a>
                    <a href="#harvest" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Thu hoạch</a>
                    <a href="#testimonials" class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">Đối tác</a>
                </nav>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-white bg-slate-950 hover:bg-slate-800 px-5 py-2.5 rounded-xl transition-all shadow-lg shadow-slate-900/10 hover:shadow-slate-900/20 hover:-translate-y-0.5">
                            Bảng điều khiển
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 px-3 py-2 transition-colors">
                            Đăng nhập
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hidden sm:inline-flex text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 px-5 py-2.5 rounded-xl transition-all shadow-lg shadow-emerald-600/10 hover:shadow-emerald-600/20 hover:-translate-y-0.5">
                                Kích hoạt hệ thống
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-slate-500 hover:text-slate-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Nav Menu -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden border-t border-slate-100 bg-white/95 backdrop-blur-md px-6 py-6 space-y-4" x-transition>
            <a href="#monitoring" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-600">Vận hành</a>
            <a href="#water" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-600">Chỉ số nước</a>
            <a href="#feeding" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-600">Cho ăn</a>
            <a href="#harvest" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-600">Thu hoạch</a>
            <hr class="border-slate-100">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block text-center text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 py-3 rounded-xl shadow-md">
                    Kích hoạt hệ thống
                </a>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative soft-grid py-24 md:py-32 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Info Column -->
            <div class="lg:col-span-7 text-left space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    HỆ THỐNG ĐANG CHẠY: ỔN ĐỊNH v2.4.2
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                    Hệ điều hành quản lý <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-sky-600">Nuôi tôm công nghiệp</span>
                </h1>
                
                <p class="text-base sm:text-lg text-slate-600 max-w-xl leading-relaxed">
                    AquaControl cung cấp giải pháp số hóa toàn diện: đo đạc chất lượng nước, lập lịch cho ăn tự động, theo dõi sinh khối tôm và tối ưu hóa chi phí vận hành cho trang trại thương mại của bạn.
                </p>

                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 px-6 py-4 rounded-xl shadow-xl shadow-slate-900/10 hover:shadow-slate-900/20 hover:-translate-y-0.5 transition-all">
                        Khởi tạo tài khoản miễn phí
                    </a>
                    <a href="#contact" class="text-sm font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 px-6 py-4 rounded-xl transition-all hover:-translate-y-0.5">
                        Yêu cầu hỗ trợ kỹ thuật
                    </a>
                </div>
            </div>

            <!-- Right Visual Dashboard Mockup with Image & Overlay card -->
            <div class="lg:col-span-5 relative">
                <!-- Main Tech Image -->
                <div class="overflow-hidden rounded-3xl border border-slate-100 shadow-2xl shadow-slate-200/50 glow-effect hover:-translate-y-1 transition-transform duration-300">
                    <img src="{{ asset('images/shrimp_farm_tech.png') }}" alt="AquaControl Shrimp Farm Technology" class="w-full h-auto object-cover aspect-[4/3] rounded-3xl">
                </div>
                
                <!-- Floating Overlay stats badge -->
                <div class="absolute -bottom-6 -left-6 bg-white/95 backdrop-blur-md border border-slate-100 p-5 shadow-xl shadow-slate-200/60 rounded-2xl min-w-[260px] hidden sm:block">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[10px] font-bold text-slate-800 uppercase tracking-wider">Cập nhật thực tế</span>
                        </div>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mono bg-slate-50 px-1.5 py-0.5 rounded">A1-16</span>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500 font-medium">Ao đang thả:</span>
                            <span class="font-bold text-slate-900 mono">16 Ao nuôi</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500 font-medium">Tuổi trung bình:</span>
                            <span class="font-bold text-slate-900 mono">64 Ngày (DOC)</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500 font-medium">Sinh khối:</span>
                            <span class="font-bold text-emerald-600 mono">14,240 kg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Farm Operation Monitoring -->
    <section id="monitoring" class="py-24 px-6 max-w-7xl mx-auto border-t border-slate-100">
        <div class="max-w-3xl mb-12">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mono bg-emerald-50 px-3 py-1 rounded-full">01 / Vận hành thực tế</span>
            <h2 class="text-3xl font-extrabold text-slate-900 mt-3">Giám sát hoạt động ao nuôi thời gian thực</h2>
            <p class="text-slate-500 mt-2 text-sm">Theo dõi trực quan trạng thái của từng ao, tuổi tôm, mật độ thả và các chỉ số đo đạc mới nhất.</p>
        </div>

        <!-- Dashboard-style Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Ao nuôi 1 -->
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-lg shadow-slate-100/70 hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-800">Ao nuôi A08</span>
                    <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100">Đang nuôi</span>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Tuổi tôm (DOC)</span>
                        <p class="text-base font-bold text-slate-900 mono">45 Ngày</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Mật độ</span>
                        <p class="text-base font-bold text-slate-900 mono">120 con/m²</p>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-50 flex items-center justify-between text-xs text-slate-500">
                    <span>Nhiệt độ: <strong class="text-slate-800 mono">28°C</strong></span>
                    <span>Oxy (DO): <strong class="text-slate-800 mono">5.8 mg/L</strong></span>
                </div>
            </div>

            <!-- Ao nuôi 2 -->
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-lg shadow-slate-100/70 hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-800">Ao nuôi A09</span>
                    <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100">Đang nuôi</span>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Tuổi tôm (DOC)</span>
                        <p class="text-base font-bold text-slate-900 mono">45 Ngày</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Mật độ</span>
                        <p class="text-base font-bold text-slate-900 mono">120 con/m²</p>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-50 flex items-center justify-between text-xs text-slate-500">
                    <span>Nhiệt độ: <strong class="text-slate-800 mono">28.5°C</strong></span>
                    <span>Oxy (DO): <strong class="text-slate-800 mono">6.1 mg/L</strong></span>
                </div>
            </div>

            <!-- Ao nuôi 3 -->
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-lg shadow-slate-100/70 hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-800">Ao nuôi B01</span>
                    <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 rounded-full border border-amber-100">Đang thu hoạch</span>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Tuổi tôm (DOC)</span>
                        <p class="text-base font-bold text-slate-900 mono">95 Ngày</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Mật độ</span>
                        <p class="text-base font-bold text-slate-900 mono">90 con/m²</p>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-50 flex items-center justify-between text-xs text-slate-500">
                    <span>Nhiệt độ: <strong class="text-slate-800 mono">27.8°C</strong></span>
                    <span>Oxy (DO): <strong class="text-slate-800 mono">5.2 mg/L</strong></span>
                </div>
            </div>

            <!-- Ao nuôi 4 -->
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-lg shadow-slate-100/70 hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-slate-800">Ao nuôi C02</span>
                    <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-slate-50 text-slate-500 rounded-full border border-slate-100">Ao trống</span>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Tuổi tôm (DOC)</span>
                        <p class="text-base font-bold text-slate-900 mono">0 Ngày</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Mật độ</span>
                        <p class="text-base font-bold text-slate-900 mono">0 con/m²</p>
                    </div>
                </div>
                <div class="mt-5 pt-4 border-t border-slate-50 flex items-center justify-between text-xs text-slate-500">
                    <span>Nhiệt độ: <strong class="text-slate-400 mono">N/A</strong></span>
                    <span>Oxy (DO): <strong class="text-slate-400 mono">N/A</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Dashboard Preview -->
    <section class="py-20 bg-gradient-to-b from-white to-slate-50/50 border-t border-slate-100 px-6">
        <div class="max-w-7xl mx-auto space-y-12">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mono bg-emerald-50 px-3 py-1 rounded-full">Trải nghiệm hệ thống</span>
                <h3 class="text-3xl font-extrabold text-slate-900">Giao diện điều khiển tinh gọn & trực quan</h3>
                <p class="text-slate-500 text-sm">Quản lý hiệu năng trang trại, đo lường chất lượng môi trường nước và tối ưu hóa lợi nhuận kinh doanh trên cùng một nền tảng chuyên nghiệp.</p>
            </div>
            
            <div class="relative max-w-5xl mx-auto rounded-3xl overflow-hidden border border-slate-200/60 shadow-2xl shadow-slate-200/80 bg-white p-2 glow-effect hover:-translate-y-1 transition-all duration-300">
                <img src="{{ asset('images/aquacontrol_dashboard.png') }}" alt="AquaControl Enterprise Dashboard Mockup" class="w-full h-auto rounded-2xl">
            </div>
        </div>
    </section>

    <!-- Section: Water Quality Tracking -->
    <section id="water" class="py-24 bg-slate-50/50 border-t border-slate-100 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Content Info -->
            <div class="lg:col-span-5 space-y-6">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mono bg-emerald-50 px-3 py-1 rounded-full">02 / Chất lượng nước</span>
                <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">Kiểm soát các chỉ số nước tối ưu</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Giảm thiểu rủi ro dịch bệnh bằng cách giám sát chặt chẽ Oxy hòa tan (DO), pH, độ mặn, nhiệt độ và độ trong của nước. Hệ thống sẽ ngay lập tức đưa ra cảnh báo khi bất kỳ chỉ số nào vượt khỏi ngưỡng sinh thái an toàn.
                </p>
                <ul class="space-y-3.5">
                    <li class="flex items-center gap-3 text-sm text-slate-600 font-medium">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Đồng bộ hóa dữ liệu kiểm thử định kỳ
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 font-medium">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Phân tích biểu đồ biến động theo ngày
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-600 font-medium">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Cảnh báo nhanh chóng qua SMS/Zalo
                    </li>
                </ul>
            </div>

            <!-- Right Telemetry Card -->
            <div class="lg:col-span-7 bg-white border border-slate-100 p-6 rounded-2xl shadow-xl shadow-slate-100">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-sm font-bold text-slate-800">Nhật ký đo đạc gần nhất: Ao nuôi A08</h4>
                    <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md mono">HÔM NAY - 16:30</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[10px] text-slate-400 uppercase font-bold tracking-wider">
                                <th class="pb-3">Chỉ số đo</th>
                                <th class="pb-3">Giá trị đo</th>
                                <th class="pb-3 text-right">Ngưỡng tiêu chuẩn</th>
                                <th class="pb-3 text-right">Đánh giá</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs font-semibold">
                            <tr>
                                <td class="py-4 text-slate-800">Oxy hòa tan (DO)</td>
                                <td class="py-4 text-slate-900 mono">6.4 mg/L</td>
                                <td class="py-4 text-right text-slate-500 mono">&gt; 5.0 mg/L</td>
                                <td class="py-4 text-right"><span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] rounded-full border border-emerald-100">Đạt chuẩn</span></td>
                            </tr>
                            <tr>
                                <td class="py-4 text-slate-800">Độ pH</td>
                                <td class="py-4 text-slate-900 mono">7.82</td>
                                <td class="py-4 text-right text-slate-500 mono">7.50 - 8.30</td>
                                <td class="py-4 text-right"><span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] rounded-full border border-emerald-100">Đạt chuẩn</span></td>
                            </tr>
                            <tr>
                                <td class="py-4 text-slate-800">Độ mặn (Salinity)</td>
                                <td class="py-4 text-slate-900 mono">18.5 ppt</td>
                                <td class="py-4 text-right text-slate-500 mono">15.0 - 25.0 ppt</td>
                                <td class="py-4 text-right"><span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] rounded-full border border-emerald-100">Đạt chuẩn</span></td>
                            </tr>
                            <tr>
                                <td class="py-4 text-slate-800">Nhiệt độ nước</td>
                                <td class="py-4 text-slate-900 mono">28.2 °C</td>
                                <td class="py-4 text-right text-slate-500 mono">26.0 - 32.0 °C</td>
                                <td class="py-4 text-right"><span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] rounded-full border border-emerald-100">Đạt chuẩn</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Feeding Optimization -->
    <section id="feeding" class="py-24 px-6 max-w-7xl mx-auto border-t border-slate-100">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Data Panels -->
            <div class="lg:col-span-7 bg-white border border-slate-100 p-6 rounded-2xl shadow-xl shadow-slate-100/70 order-2 lg:order-1">
                <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-4">
                    <h4 class="text-sm font-bold text-slate-800">Đề xuất khẩu phần ăn & Quản lý thức ăn kho</h4>
                    <span class="px-2 py-0.5 text-[9px] font-bold bg-sky-50 text-sky-700 rounded-md border border-sky-100 uppercase tracking-wider">Khuyến nghị AI</span>
                </div>
                
                <div class="space-y-4">
                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100 flex justify-between items-center text-xs">
                        <span class="text-slate-500 font-semibold uppercase">Loại cám thức ăn sử dụng</span>
                        <strong class="text-slate-800 font-bold">Uni-President Grower #3</strong>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="bg-white border border-slate-100 p-3.5 rounded-xl">
                            <span class="text-[10px] text-slate-400 uppercase font-semibold">Khẩu phần / Ngày</span>
                            <p class="text-sm font-bold text-slate-900 mt-1 mono">190 kg</p>
                        </div>
                        <div class="bg-white border border-slate-100 p-3.5 rounded-xl">
                            <span class="text-[10px] text-slate-400 uppercase font-semibold">Chỉ số FCR dự tính</span>
                            <p class="text-sm font-bold text-slate-900 mt-1 mono">1.28</p>
                        </div>
                        <div class="bg-white border border-slate-100 p-3.5 rounded-xl">
                            <span class="text-[10px] text-slate-400 uppercase font-semibold">Tồn kho còn lại</span>
                            <p class="text-sm font-bold text-slate-900 mt-1 mono">4,200 kg</p>
                        </div>
                    </div>
                    
                    <div class="border border-slate-100 rounded-xl overflow-hidden">
                        <div class="bg-slate-50 px-4 py-2.5 text-[10px] uppercase font-bold text-slate-500 border-b border-slate-100 tracking-wider">
                            Chia ca cho ăn thông minh hàng ngày
                        </div>
                        <div class="divide-y divide-slate-50 text-xs px-4">
                            <div class="py-3 flex justify-between">
                                <span class="text-slate-600 font-medium">Ca sáng (06:00)</span>
                                <strong class="text-slate-900 mono">45 kg (Cánh quạt chạy 100%)</strong>
                            </div>
                            <div class="py-3 flex justify-between">
                                <span class="text-slate-600 font-medium">Ca trưa (11:00)</span>
                                <strong class="text-slate-900 mono">55 kg</strong>
                            </div>
                            <div class="py-3 flex justify-between">
                                <span class="text-slate-600 font-medium">Ca chiều (16:00)</span>
                                <strong class="text-slate-900 mono">50 kg</strong>
                            </div>
                            <div class="py-3 flex justify-between">
                                <span class="text-slate-600 font-medium">Ca tối (21:00)</span>
                                <strong class="text-slate-900 mono">40 kg</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Info Column -->
            <div class="lg:col-span-5 order-1 lg:order-2 space-y-6">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mono bg-emerald-50 px-3 py-1 rounded-full">03 / Dinh dưỡng & FCR</span>
                <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">Tối ưu hóa hệ số chuyển đổi thức ăn (FCR)</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Chi phí thức ăn thường chiếm tới 60% tổng chi phí sản xuất. AquaControl tự động tính toán nhu cầu dinh dưỡng dựa trên DOC, nhiệt độ nước và tăng trưởng thực tế để đề xuất lượng cám tối ưu, tránh dư thừa gây ô nhiễm đáy ao.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 border border-slate-100 rounded-2xl bg-white shadow-sm">
                        <h5 class="text-xs font-bold text-slate-800 uppercase">Trừ kho vật tư tự động</h5>
                        <p class="text-[11px] text-slate-500 mt-1">Khi ghi nhận ca cho ăn, nguyên liệu trong kho tự động được cập nhật khấu hao.</p>
                    </div>
                    <div class="p-4 border border-slate-100 rounded-2xl bg-white shadow-sm">
                        <h5 class="text-xs font-bold text-slate-800 uppercase">Đối chiếu sinh khối</h5>
                        <p class="text-[11px] text-slate-500 mt-1">Tính toán chính xác tốc độ tăng trưởng sinh học theo định kỳ sàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Harvest Analytics -->
    <section id="harvest" class="py-24 bg-slate-50/50 border-t border-slate-100 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Info Column -->
            <div class="lg:col-span-5 space-y-6">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mono bg-emerald-50 px-3 py-1 rounded-full">04 / Báo cáo sản lượng</span>
                <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">Phân tích kết quả thu hoạch & lợi nhuận</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Theo dõi sản lượng thực tế và quy đổi kích cỡ tôm thương phẩm. Hệ thống phân chia tỷ lệ tôm sống loại 1, tôm loại 2 và tôm ngộp, giúp hạch toán nhanh doanh thu và lợi nhuận thuần ngay khi hoàn tất hóa đơn bán.
                </p>
                <div class="p-4 bg-white border border-slate-100 rounded-2xl shadow-sm">
                    <h5 class="text-xs font-bold text-slate-800 uppercase mb-1">Thu hoạch tỉa vs Thu hoạch toàn bộ</h5>
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        Phân tách sản lượng thu hoạch tỉa định kỳ nhằm giảm mật độ nuôi, kích thích sự phát triển vượt trội của số tôm còn lại trong ao.
                    </p>
                </div>
            </div>

            <!-- Right Visual Panel -->
            <div class="lg:col-span-7 bg-white border border-slate-100 p-6 rounded-2xl shadow-xl shadow-slate-100">
                <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-6">
                    <h4 class="text-sm font-bold text-slate-800">Báo cáo doanh số bán tôm hoàn tất</h4>
                    <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100">ĐÃ GHI NHẬN</span>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-6 text-center">
                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-50">
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Khối lượng</span>
                        <p class="text-base font-bold text-slate-900 mt-1 mono">8,240 kg</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-50">
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Kích cỡ (Size)</span>
                        <p class="text-base font-bold text-slate-900 mt-1 mono">45 con/kg</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-50">
                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Thành tiền thuần</span>
                        <p class="text-base font-bold text-emerald-600 mt-1 mono">1,420,000,000 đ</p>
                    </div>
                </div>

                <div class="border border-slate-100 rounded-xl overflow-hidden">
                    <div class="bg-slate-50 px-4 py-2.5 text-[10px] uppercase font-bold text-slate-500 border-b border-slate-100 tracking-wider">
                        Phân bổ tỷ lệ thương phẩm thực tế
                    </div>
                    <div class="divide-y divide-slate-50 text-xs px-4">
                        <div class="py-3 flex justify-between items-center">
                            <span class="text-slate-600 font-medium">Tôm sống loại 1 (Size 30-40)</span>
                            <span class="text-slate-900 font-bold mono">4,500 kg (54.6%)</span>
                        </div>
                        <div class="py-3 flex justify-between items-center">
                            <span class="text-slate-600 font-medium">Tôm ke nhỏ loại 2 (Size 50-60)</span>
                            <span class="text-slate-900 font-bold mono">2,800 kg (33.9%)</span>
                        </div>
                        <div class="py-3 flex justify-between items-center">
                            <span class="text-slate-600 font-medium">Tôm ngộp / Hao hụt (Size &gt; 80)</span>
                            <span class="text-slate-400 font-medium mono">940 kg (11.5%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Testimonials -->
    <section id="testimonials" class="py-24 px-6 bg-slate-50/20 border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest mono bg-emerald-50 px-3 py-1 rounded-full">Đối tác tin cậy</span>
                <h3 class="text-3xl font-extrabold text-slate-900">Được tin dùng bởi các chủ trang trại lớn</h3>
                <p class="text-slate-500 text-sm">Hãy nghe chia sẻ của những người vận hành trang trại về sự chuyển đổi hiệu quả kể từ khi ứng dụng hệ thống của chúng tôi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white border border-slate-100 p-8 rounded-2xl shadow-lg shadow-slate-100/70 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 relative">
                    <span class="text-6xl text-emerald-100 font-serif absolute -top-2 left-6 pointer-events-none select-none">“</span>
                    <p class="text-sm text-slate-600 italic relative z-10 leading-relaxed pt-4">
                        AquaControl đã giúp chúng tôi số hóa toàn bộ nhật ký chỉ số nước của 15 ao nuôi. Việc kiểm soát FCR được tính toán tự động giúp trang trại tiết kiệm được hơn 70 triệu đồng tiền thức ăn bị lãng phí trong vụ nuôi vừa qua.
                    </p>
                    <div class="mt-8 flex items-center gap-3 border-t border-slate-50 pt-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-sky-400 flex items-center justify-center text-xs font-bold text-white shadow-sm">HL</div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Bùi Khánh Lân</h5>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-0.5">Giám đốc Điều hành, Hợp tác xã Bình Minh</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white border border-slate-100 p-8 rounded-2xl shadow-lg shadow-slate-100/70 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 relative">
                    <span class="text-6xl text-emerald-100 font-serif absolute -top-2 left-6 pointer-events-none select-none">“</span>
                    <p class="text-sm text-slate-600 italic relative z-10 leading-relaxed pt-4">
                        Tính năng phân bổ chi phí vận hành giúp chúng tôi hạch toán chính xác chi phí tiền điện, nhân công và dầu phát sinh cho từng ao. Điều này rất quan trọng đối với kế toán doanh nghiệp lớn.
                    </p>
                    <div class="mt-8 flex items-center gap-3 border-t border-slate-50 pt-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-sky-400 flex items-center justify-center text-xs font-bold text-white shadow-sm">NT</div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Nguyễn Văn Tiến</h5>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-0.5">Trưởng bộ phận Sản xuất, VietShrimp Group</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Contact Form -->
    <section id="contact" class="py-24 px-6 max-w-4xl mx-auto border-t border-slate-100">
        <div class="bg-white border border-slate-100 p-8 md:p-12 shadow-2xl shadow-slate-100 rounded-3xl relative overflow-hidden">
            <!-- Glow background decorative shape inside container -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-emerald-100/40 rounded-full blur-[100px] pointer-events-none -z-10"></div>
            
            <h3 class="text-2xl font-bold text-slate-900 mb-2">Đăng ký tư vấn giải pháp cho doanh nghiệp</h3>
            <p class="text-xs text-slate-500 mb-8 leading-relaxed max-w-xl">
                Để lại thông tin liên hệ của bạn, đội ngũ kỹ thuật của AquaControl sẽ kết nối trực tiếp để hướng dẫn cài đặt kết nối và tối ưu hóa hệ thống cho trang trại của bạn.
            </p>

            <form action="#" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] uppercase font-bold text-slate-400 mb-2 tracking-wider">Họ và tên của bạn</label>
                        <input type="text" placeholder="Nguyễn Văn A" class="w-full bg-slate-50/50 border border-slate-200/80 p-3.5 text-sm focus:outline-none focus:border-emerald-500 focus:bg-white rounded-xl transition-all duration-200">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold text-slate-400 mb-2 tracking-wider">Số điện thoại liên hệ</label>
                        <input type="text" placeholder="0901234567" class="w-full bg-slate-50/50 border border-slate-200/80 p-3.5 text-sm focus:outline-none focus:border-emerald-500 focus:bg-white rounded-xl transition-all duration-200">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] uppercase font-bold text-slate-400 mb-2 tracking-wider">Quy mô ao nuôi hiện tại</label>
                    <select class="w-full bg-slate-50/50 border border-slate-200/80 p-3.5 text-sm focus:outline-none focus:border-emerald-500 focus:bg-white rounded-xl transition-all duration-200 text-slate-600">
                        <option>Dưới 5 Ao nuôi</option>
                        <option>Từ 5 - 20 Ao nuôi</option>
                        <option>Trên 20 Ao nuôi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] uppercase font-bold text-slate-400 mb-2 tracking-wider">Yêu cầu bổ sung của bạn</label>
                    <textarea rows="4" placeholder="Mô tả qua tình hình hoạt động hiện tại của ao nuôi hoặc các tính năng bạn muốn trải nghiệm thử..." class="w-full bg-slate-50/50 border border-slate-200/80 p-3.5 text-sm focus:outline-none focus:border-emerald-500 focus:bg-white rounded-xl transition-all duration-200"></textarea>
                </div>
                <button type="submit" class="w-full text-center text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 py-4 rounded-xl transition-all shadow-xl shadow-emerald-600/10 hover:shadow-emerald-600/20 hover:-translate-y-0.5">
                    Gửi thông tin đăng ký tư vấn
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-100 bg-white py-12 px-6">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-6 text-xs text-slate-400">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-emerald-500 to-sky-500 p-[1.5px] shadow-sm">
                    <div class="w-full h-full bg-white rounded-[6px] flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12c0-3 3-3 3-3s3 3 6 3 6-3 6-3v6s-3 3-6 3-6-3-6-3z" />
                        </svg>
                    </div>
                </div>
                <span class="font-extrabold text-slate-900 uppercase">AquaControl Platforms</span>
            </div>
            <div>
                &copy; {{ date('Y') }} AquaControl Platforms Inc. Đã đồng bộ và vận hành ổn định.
            </div>
            <div class="flex gap-6 font-semibold">
                <a href="#" class="hover:text-slate-900 transition-colors uppercase tracking-wider">Bảo mật</a>
                <a href="#" class="hover:text-slate-900 transition-colors uppercase tracking-wider">Điều khoản</a>
            </div>
        </div>
    </footer>

</body>
</html>