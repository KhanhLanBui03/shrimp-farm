<form method="POST" action="{{ route('materials.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Tên vật tư *</label>
            <input type="text" name="name" placeholder="Thức ăn GrowMax 02" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Nhà cung cấp *</label>
            <select name="supplier_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allSuppliers as $sup)
                    <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Phân loại *</label>
            <select name="type" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="feed">Thức ăn</option>
                <option value="medicine">Thuốc</option>
                <option value="probiotic">Vi sinh</option>
                <option value="mineral">Khoáng</option>
                <option value="chemical">Hóa chất</option>
                <option value="other">Khác</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Thương hiệu</label>
            <input type="text" name="brand" placeholder="GrowMax"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Kích cỡ hạt (mm)</label>
            <input type="number" step="0.1" name="pellet_size" placeholder="1.2"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Quy cách/Đơn vị *</label>
            <input type="text" name="unit" placeholder="Bao (25kg)" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Số lượng tồn *</label>
            <input type="number" name="stock_quantity" placeholder="1200" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Đơn giá nhập *</label>
            <input type="number" name="unit_price" placeholder="380000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div>
        <label class="block mb-1">Hạn sử dụng</label>
        <input type="date" name="expiration_date"
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
