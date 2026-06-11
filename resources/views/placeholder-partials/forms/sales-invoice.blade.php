<form method="POST" action="{{ route('sales-invoices.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Mã hóa đơn bán hàng *</label>
            <input type="text" name="invoice_number" placeholder="HD-2026-041" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Thương lái / Khách hàng *</label>
            <select name="customer_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allCustomers as $cust)
                    <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Đợt thu hoạch liên kết *</label>
            <select name="harvest_id" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                @foreach($allHarvests as $harv)
                    <option value="{{ $harv->id }}">TH-{{ $harv->id }} (Ao {{ $harv->pond->name ?? 'N/A' }}
                        - {{ number_format($harv->weight) }}kg)</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1">Ngày hóa đơn *</label>
            <input type="date" name="invoice_date" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Tổng tiền hóa đơn *</label>
            <input type="number" name="total_amount" placeholder="672000000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Đã thanh toán trước *</label>
            <input type="number" name="paid_amount" placeholder="672000000" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Trạng thái thanh toán *</label>
            <select name="status" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                <option value="paid">Đã thanh toán hoàn toàn</option>
                <option value="unpaid">Nợ gối đầu / Chưa thanh toán</option>
            </select>
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
