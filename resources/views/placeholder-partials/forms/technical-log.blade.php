<form method="POST" action="{{ route('technical-logs.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Vụ nuôi *</label>
            <select name="cultivation_cycle_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allCycles as $cycle)
                    <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1">Ao nuôi *</label>
            <select name="pond_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allPonds as $pond)
                    <option value="{{ $pond->id }}">{{ $pond->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Ngày ghi nhận *</label>
            <input type="date" name="date" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Số lượng thức ăn (kg) *</label>
            <input type="number" name="feed_amount" placeholder="45" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Trọng lượng TB tôm (g) *</label>
            <input type="number" step="0.01" name="shrimp_size" placeholder="12.5" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Tỉ lệ sống ước tính (%) *</label>
            <input type="number" name="estimated_survival" placeholder="90" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div>
        <label class="block mb-1">Ghi chú kỹ thuật</label>
        <textarea name="notes" placeholder="Thay nước 10%, bổ sung khoáng bột..."
            class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500"></textarea>
    </div>
    <div class="flex justify-end space-x-2.5 pt-4">
        <button @click="showAddModal = false" type="button"
            class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu
            lại</button>
    </div>
</form>
