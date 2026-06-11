<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Allocation Rule Widget -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Quy tắc phân bổ chi phí</h3>
        <div class="space-y-3 text-xs">
            <div class="p-3 bg-slate-50 rounded-xl border border-slate-150">
                <span class="font-bold text-slate-700 block">Phân bổ đích danh (Direct)</span>
                <span class="text-[10px] text-slate-400 mt-0.5 block">100% chi phí được ghi nhận trực tiếp cho 1 ao nuôi hoặc khu nuôi cụ thể.</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl border border-slate-150">
                <span class="font-bold text-slate-700 block">Phân bổ chia đều (Equal Split)</span>
                <span class="text-[10px] text-slate-400 mt-0.5 block">Chi phí chung (điện, nước sinh hoạt) được hệ thống tự động chia đều theo diện tích hoặc số ao hoạt động.</span>
            </div>
        </div>
    </div>

    <!-- Expense Distribution Chart -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-3">
        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Cơ cấu phân bố chi phí vận hành</h3>
        <div class="relative h-44">
            <canvas id="expenseDistributionChart"></canvas>
        </div>
    </div>
</div>
