<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Bảng điều khiển hệ thống
        </h2>
    </x-slot>

    <!-- Dashboard Content Wrapper -->
    <div class="space-y-6">
        <!-- Welcome banner -->
        <div class="bg-gradient-to-r from-emerald-600 to-teal-500 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            <div class="absolute right-0 top-0 bottom-0 opacity-10 flex items-center pointer-events-none pr-8">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H7c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.04-.42 1.99-1.07 2.75z"/>
                </svg>
            </div>
            <div class="relative z-10 space-y-2">
                <h1 class="text-3xl font-black tracking-tight">Xin chào, {{ Auth::user()->name }}!</h1>
                <p class="text-emerald-100 text-sm max-w-xl">Hệ thống đang hoạt động ổn định. Xem nhanh các thông số vận hành, thống kê chi phí và trạng thái kỹ thuật hôm nay.</p>
                <div class="pt-2 flex items-center space-x-3 text-xs font-semibold">
                    <span class="bg-emerald-500/30 px-3 py-1 rounded-full text-white border border-emerald-400/20">Vai trò: {{ Auth::user()->role->value ?? 'Người dùng' }}</span>
                    <span class="text-emerald-200">•</span>
                    <span class="text-emerald-100" x-data="{ time: new Date().toLocaleDateString('vi-VN', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }" x-text="time"></span>
                </div>
            </div>
        </div>

        <!-- Core Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tổng phân khu</span>
                    <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $totalZones }}</span>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tổng số ao nuôi</span>
                    <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $totalPonds }}</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Vụ nuôi đang chạy</span>
                    <span class="text-3xl font-black text-amber-500 mt-1 block">{{ $activeCycles }}</span>
                </div>
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tổng chi phí phát sinh</span>
                    <span class="text-3xl font-black text-rose-600 mt-1 block">{{ number_format($totalExpenses) }}đ</span>
                </div>
                <div class="p-3 bg-rose-50 text-rose-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Quick actions and alerts grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 cols for Charts -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Monthly Cost Chart -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-md font-bold text-slate-900">Chi phí vận hành năm 2026</h3>
                            <p class="text-xs text-slate-500">Phân bố tổng chi phí phát sinh thực tế hàng tháng</p>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="monthlyCostChart"></canvas>
                    </div>
                </div>

                <!-- Recent activity table -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-md font-bold text-slate-900">Nhật ký kỹ thuật gần nhất</h3>
                            <p class="text-xs text-slate-500">Các hoạt động theo dõi ao nuôi vừa cập nhật</p>
                        </div>
                        <a href="{{ route('technical-logs.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Xem tất cả →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-slate-50/60 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100 whitespace-nowrap">
                                    <th class="py-3 px-4">Ngày ghi</th>
                                    <th class="py-3 px-4">Ao nuôi</th>
                                    <th class="py-3 px-4">Vụ nuôi</th>
                                    <th class="py-3 px-4 text-center">pH</th>
                                    <th class="py-3 px-4 text-right">Lượng ăn (kg)</th>
                                    <th class="py-3 px-4">Kích thước tôm</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                                @forelse($recentLogs as $log)
                                    <tr class="hover:bg-slate-50/20 whitespace-nowrap">
                                        <td class="py-3 px-4 font-mono font-semibold">{{ date('d/m/Y', strtotime($log->date)) }}</td>
                                        <td class="py-3 px-4 font-bold text-slate-800">{{ $log->pond->name ?? 'N/A' }}</td>
                                        <td class="py-3 px-4">{{ $log->cultivationCycle->name ?? 'N/A' }}</td>
                                        <td class="py-3 px-4 text-center font-bold font-mono">{{ $log->ph }}</td>
                                        <td class="py-3 px-4 text-right font-bold font-mono">{{ number_format($log->feed_amount, 1) }}</td>
                                        <td class="py-3 px-4">{{ $log->shrimp_size ? $log->shrimp_size . ' con/kg' : 'Chưa đo' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-slate-400 font-normal">Không có nhật ký kỹ thuật nào gần đây.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right col for Status distribution & Actions -->
            <div class="space-y-6">
                <!-- Pie Chart for Pond Statuses -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                    <h3 class="text-md font-bold text-slate-900 mb-1">Trạng thái ao nuôi</h3>
                    <p class="text-xs text-slate-500 mb-4">Tỷ lệ trạng thái của toàn bộ ao nuôi trong hệ thống</p>
                    <div class="relative h-56 flex items-center justify-center">
                        <canvas id="pondStatusChart" class="max-w-[200px] max-h-[200px]"></canvas>
                    </div>
                </div>

                <!-- Water Quality Warning Widget -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                    <div>
                        <h3 class="text-md font-bold text-slate-900">Cảnh báo môi trường nước</h3>
                        <p class="text-xs text-slate-500">Dữ liệu lấy từ các mẫu đo mới nhất</p>
                    </div>

                    <div class="space-y-3">
                        @php
                            $hasAlert = false;
                        @endphp
                        @forelse($latestWaterLogs->take(3) as $wLog)
                            @php
                                $phVal = floatval($wLog->ph);
                                $isPhAlert = $phVal < 7.5 || $phVal > 8.5;
                                if ($isPhAlert) $hasAlert = true;
                            @endphp
                            <div class="p-3.5 rounded-2xl border flex items-start space-x-3 {{ $isPhAlert ? 'bg-amber-50/50 border-amber-100 text-amber-800' : 'bg-slate-50/50 border-slate-100 text-slate-700' }}">
                                <span class="p-2 rounded-xl {{ $isPhAlert ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-500' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 9.172V5L8 4z"/>
                                    </svg>
                                </span>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold">{{ $wLog->sampling_location ?? 'Mẫu đo' }}</span>
                                        <span class="text-[10px] font-mono text-slate-400">{{ date('d/m H:i', strtotime($wLog->date . ' ' . $wLog->time)) }}</span>
                                    </div>
                                    <p class="text-xs mt-1">Độ pH đo được: <span class="font-bold font-mono">{{ $wLog->ph }}</span></p>
                                    @if($isPhAlert)
                                        <p class="text-[10px] text-amber-600 mt-0.5 font-semibold">⚠️ pH vượt ngưỡng tối ưu (7.5 - 8.5)</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-4">Chưa có kết quả phân tích chất lượng nước.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Action panel -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                    <h3 class="text-md font-bold text-slate-900 mb-3">Thao tác nhanh</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('farming-zones.index') }}" class="p-3 bg-slate-50 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 rounded-2xl border border-slate-100 text-center transition-all block">
                            <span class="text-lg block mb-1">🏢</span>
                            <span class="text-xs font-bold block">Thêm Khu</span>
                        </a>
                        <a href="{{ route('ponds.index') }}" class="p-3 bg-slate-50 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 rounded-2xl border border-slate-100 text-center transition-all block">
                            <span class="text-lg block mb-1">💧</span>
                            <span class="text-xs font-bold block">Thêm Ao</span>
                        </a>
                        <a href="{{ route('technical-logs.index') }}" class="p-3 bg-slate-50 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 rounded-2xl border border-slate-100 text-center transition-all block">
                            <span class="text-lg block mb-1">📝</span>
                            <span class="text-xs font-bold block">Ghi Nhật Ký</span>
                        </a>
                        <a href="{{ route('operating-expenses.index') }}" class="p-3 bg-slate-50 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 rounded-2xl border border-slate-100 text-center transition-all block">
                            <span class="text-lg block mb-1">💰</span>
                            <span class="text-xs font-bold block">Thêm Chi Phí</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js scripts integration -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Monthly Cost Bar Chart
            const costCtx = document.getElementById('monthlyCostChart').getContext('2d');
            new Chart(costCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Chi phí phát sinh (VND)',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: '#059669', // Emerald 600
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: '#f1f5f9'
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 10 }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });

            // 2. Pond Status Doughnut Chart
            const statusCtx = document.getElementById('pondStatusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Đang nuôi', 'Cải tạo ao', 'Sẵn sàng thả', 'Ao trống'],
                    datasets: [{
                        data: [
                            {{ $pondsStatus['rearing'] }},
                            {{ $pondsStatus['rehabilitating'] }},
                            {{ $pondsStatus['ready'] }},
                            {{ $pondsStatus['empty'] }}
                        ],
                        backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#94a3b8'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                color: '#64748b',
                                font: { size: 10 }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</x-app-layout>
