<form method="POST" action="{{ route('seed-batches.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Vụ nuôi liên kết *</label>
            <select name="cultivation_cycle_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allCycles as $cycle)
                    <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1">Ao nuôi thả *</label>
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
            <label class="block mb-1">Nhà cung cấp giống *</label>
            <select name="supplier_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allSuppliers as $sup)
                    <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1">Mã lô giống *</label>
            <input type="text" name="lot_number" placeholder="LG-CP-009" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Số lượng thả *</label>
            <input type="number" name="quantity" placeholder="300000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Mật độ thả *</label>
            <input type="number" name="stocking_density" placeholder="150" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Loại tôm giống *</label>
            <input type="text" name="seed_type" value="Tôm thẻ chân trắng" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div>
        <label class="block mb-1">Ngày thả giống *</label>
        <input type="date" name="stocking_date" required
            class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
    </div>
    <div class="flex justify-end space-x-2.5 pt-4">
        <button @click="showAddModal = false" type="button"
            class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu
            lại</button>
    </div>
</form>
