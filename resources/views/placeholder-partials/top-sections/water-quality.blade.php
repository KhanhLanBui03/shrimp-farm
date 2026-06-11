<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Real-time Alerts Widget -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Hệ thống cảnh báo đỏ tức thời</h3>
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
            </span>
        </div>
        <div class="space-y-2.5">
            @if(isset($alerts) && count($alerts) > 0)
                @foreach($alerts as $alert)
                    <div class="p-3 {{ $alert['type'] === 'danger' ? 'bg-rose-50/60 border-rose-100 text-rose-800' : 'bg-amber-50/60 border-amber-100 text-amber-800' }} border rounded-xl text-xs flex items-start space-x-2.5">
                        <span class="text-sm">⚠️</span>
                        <div>
                            <span class="font-bold">{{ $alert['location'] }}</span>
                            <p class="text-[10px] {{ $alert['type'] === 'danger' ? 'text-rose-600' : 'text-amber-600' }} mt-0.5">{{ $alert['message'] }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-3 bg-emerald-50/60 border border-emerald-100 rounded-xl text-emerald-800 text-xs flex items-start space-x-2.5">
                    <span class="text-sm">✅</span>
                    <div>
                        <span class="font-bold">Mọi chỉ số đều ổn định</span>
                        <p class="text-[10px] text-emerald-600 mt-0.5">Không có cảnh báo nào trong thời gian gần đây.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Temperature Comparison Chart -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Biểu đồ so sánh nhiệt độ nước vs nhiệt độ không khí</h3>
            <span class="text-[10px] text-slate-400 font-semibold">Đơn vị đo: °C</span>
        </div>
        <div class="relative h-44">
            <canvas id="waterAirTempChart"></canvas>
        </div>
    </div>
</div>

<!-- Tabs for Ao Nuoi vs Ao Lang vs Cau Cap -->
<div class="flex space-x-2 bg-slate-100 p-1 rounded-xl w-fit">
    <button @click="activeTab = 'ao_nuoi'"
        :class="activeTab === 'ao_nuoi' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all">
        Chỉ số Ao Nuôi
    </button>
    <button @click="activeTab = 'ao_lang'"
        :class="activeTab === 'ao_lang' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all">
        Chỉ số Ao Lắng
    </button>
    <button @click="activeTab = 'cau_cap'"
        :class="activeTab === 'cau_cap' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all">
        Mực nước Cầu Cấp
    </button>
</div>
