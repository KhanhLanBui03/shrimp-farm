<form method="POST" action="{{ route('operating-expenses.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Ngày chi *</label>
            <input type="date" name="date" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Danh mục chi phí *</label>
            <select name="expense_type" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="electricity">Điện & Năng lượng</option>
                <option value="feed">Thức ăn</option>
                <option value="salary">Lương nhân sự</option>
                <option value="fuel">Nhiên liệu</option>
                <option value="maintenance">Bảo trì ao</option>
                <option value="chemicals">Hóa chất</option>
                <option value="probiotic">Vi sinh</option>
                <option value="mineral">Khoáng</option>
                <option value="seed">Tôm giống</option>
                <option value="other">Chi phí khác</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Loại trung tâm chi phí *</label>
            <select name="cost_center_type" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="zone">Khu nuôi (Zone)</option>
                <option value="pond">Ao nuôi (Pond)</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">ID Trung tâm chi phí *</label>
            <input type="number" name="cost_center_id" placeholder="1" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Phương thức phân bổ *</label>
            <select name="allocation_method" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="direct">Phân bổ trực tiếp</option>
                <option value="equal_split">Chia đều</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Số tiền chi (đ) *</label>
            <input type="number" name="amount" placeholder="54200000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Chi tiết nghiệp vụ *</label>
            <input type="text" name="description"
                placeholder="Thanh toán tiền điện trạm hạ thế tháng 05" required
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
