<div class="space-y-5">
    <!-- Basic Info Cards Grid -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100/80">
            <span class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Mã vụ nuôi</span>
            <span class="font-bold text-slate-800 text-sm" x-text="detailData.code"></span>
        </div>
        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100/80">
            <span class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Tên vụ nuôi</span>
            <span class="font-bold text-slate-800 text-sm" x-text="detailData.name"></span>
        </div>
        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100/80">
            <span class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Ngày bắt đầu</span>
            <span class="font-bold text-slate-800 text-sm" x-text="detailData.start_date"></span>
        </div>
        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100/80">
            <span class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Trạng thái</span>
            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border"
                  :class="{
                      'text-amber-700 bg-amber-50 border-amber-200': detailData.status === 'planning',
                      'text-indigo-700 bg-indigo-50 border-indigo-200': detailData.status === 'active',
                      'text-emerald-700 bg-emerald-50 border-emerald-200': detailData.status === 'completed',
                      'text-rose-700 bg-rose-50 border-rose-200': detailData.status === 'cancelled'
                  }"
                  x-text="detailData.status === 'planning' ? 'Lập kế hoạch' : (detailData.status === 'active' ? 'Đang nuôi' : (detailData.status === 'completed' ? 'Đã hoàn thành' : 'Đã hủy'))">
            </span>
        </div>
    </div>

    <!-- Ponds List -->
    <div class="border border-slate-150 rounded-xl p-4 bg-slate-50/30">
        <h4 class="text-xs font-bold text-slate-700 mb-3 flex items-center space-x-1.5">
            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span>Danh sách ao nuôi tham gia</span>
        </h4>
        
        <!-- Scrollable Ponds container -->
        <div class="max-h-40 overflow-y-auto space-y-2 pr-1 custom-scrollbar">
            <template x-for="pond in detailData.ponds" :key="pond.id">
                <div class="flex items-center justify-between p-2.5 bg-white border border-slate-100 rounded-lg hover:border-slate-200 transition-colors shadow-sm">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-indigo-500"></div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-slate-800" x-text="pond.name"></span>
                            <span class="text-[10px] text-slate-400" x-text="`Mã ao: ${pond.code}`"></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200"
                              x-text="pond.pond_type === 'nursery' ? 'Ao gièo' : 'Ao nuôi'"></span>
                        <span class="block text-[10px] text-slate-400 mt-0.5" x-text="`Diện tích: ${pond.area} m²`"></span>
                    </div>
                </div>
            </template>
            <template x-if="!detailData.ponds || detailData.ponds.length === 0">
                <p class="text-center py-4 text-slate-400 italic text-xs">Chưa có ao nào tham gia vụ này.</p>
            </template>
        </div>
    </div>
</div>
