<form method="POST" action="{{ route('harvests.store') }}"
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
            <label class="block mb-1">Ao thu hoạch *</label>
            <select name="pond_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allPonds as $pond)
                    <option value="{{ $pond->id }}">{{ $pond->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Ngày thu hoạch *</label>
            <input type="date" name="harvest_date" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Tuổi tôm DOC *</label>
            <input type="number" name="doc" placeholder="90" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Hình thức thu *</label>
            <select name="harvest_type" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="total">Thu toàn bộ</option>
                <option value="partial">Thu tỉa bớt</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Khối lượng (kg) *</label>
            <input type="number" name="weight" placeholder="4200" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Số lượng (con) *</label>
            <input type="number" name="quantity" placeholder="160000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Tình trạng tôm *</label>
            <select name="shrimp_condition" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="alive">Tôm sống</option>
                <option value="dead">Tôm ngộp/chết</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Kích cỡ Size (con/kg)</label>
            <input type="text" name="size_range" placeholder="38 con/kg"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Đơn giá bán *</label>
            <input type="number" name="unit_price" placeholder="160000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Phí thuê tay lưới (nếu có)</label>
            <input type="number" name="net_rental_fee" value="0"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="flex justify-end space-x-2.5 pt-4">
        <button @click="showAddModal = false" type="button"
            class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu
            lại</button>
    </div>
</form>
