<form method="POST" action="{{ route('customers.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Tên khách hàng / Thương lái *</label>
            <input type="text" name="name" placeholder="Thương lái Trần Văn Thành" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Số điện thoại *</label>
            <input type="text" name="phone" placeholder="0909-382-xxx" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" placeholder="thanhtran@gmail.com"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">STK Ngân hàng</label>
            <input type="text" name="bank_account" placeholder="Vietcombank - 0071..."
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Địa bàn / Địa chỉ thu mua</label>
            <input type="text" name="address" placeholder="Bạc Liêu, Sóc Trăng"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Dư nợ ban đầu (đ)</label>
            <input type="number" name="debt" value="0"
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
