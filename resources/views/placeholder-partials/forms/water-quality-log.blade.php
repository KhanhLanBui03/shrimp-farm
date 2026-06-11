<form method="POST" action="{{ route('water-quality-logs.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Ngày đo *</label>
            <input type="date" name="date" value="{{ date('Y-m-d') }}" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
        <div>
            <label class="block mb-1">Giờ đo *</label>
            <input type="time" name="time" value="{{ date('H:i') }}" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
        </div>
    </div>

    <!-- Dropdowns for sampling location mapping automatically to selected activeTab -->
    <div>
        <label class="block mb-1">Vị trí lấy mẫu *</label>

        <!-- Dropdown for Ao Nuoi -->
        <select x-show="activeTab === 'ao_nuoi'" name="sampling_location"
            class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
            :disabled="activeTab !== 'ao_nuoi'">
            @foreach($allPonds as $pond)
                <option value="{{ $pond->name }}">{{ $pond->name }}</option>
            @endforeach
        </select>

        <!-- Dropdown for Ao Lang -->
        <select x-show="activeTab === 'ao_lang'" name="sampling_location"
            class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
            :disabled="activeTab !== 'ao_lang'">
            <option value="Ao Lắng A">Ao Lắng A (Khu Tây)</option>
            <option value="Ao Lắng B">Ao Lắng B (Khu Đông)</option>
        </select>

        <!-- Dropdown for Cau Cap -->
        <select x-show="activeTab === 'cau_cap'" name="sampling_location"
            class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
            :disabled="activeTab !== 'cau_cap'">
            <option value="Cầu Cấp A">Cầu Cấp A (Sông Tiền)</option>
            <option value="Cầu Cấp B">Cầu Cấp B (Kênh Chính)</option>
        </select>
    </div>

    <!-- Fields for Ao Nuoi -->
    <div x-show="activeTab === 'ao_nuoi'" class="space-y-4">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block mb-1">pH (đơn vị)</label>
                <input type="number" step="0.1" name="ph" placeholder="7.8"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
            <div>
                <label class="block mb-1">Oxy hòa tan DO (mg/L)</label>
                <input type="number" step="0.1" name="do" placeholder="5.2"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
            <div>
                <label class="block mb-1">Độ Mặn (ppt)</label>
                <input type="number" step="0.1" name="salinity" placeholder="15"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Khí Độc NH₃ (mg/L)</label>
                <input type="number" step="0.01" name="nh3" placeholder="0.01"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
            <div>
                <label class="block mb-1">Khí Độc H₂S (mg/L)</label>
                <input type="number" step="0.001" name="h2s" placeholder="0.002"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block mb-1">Nhiệt độ (°C)</label>
                <input type="number" step="0.1" name="temperature" placeholder="29.5"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
            <div>
                <label class="block mb-1">Độ Kiềm (mg/L)</label>
                <input type="number" step="1" name="alkalinity" placeholder="120"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_nuoi'">
            </div>
        </div>
    </div>

    <!-- Fields for Ao Lang -->
    <div x-show="activeTab === 'ao_lang'" class="space-y-4">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block mb-1">Độ Mặn (ppt)</label>
                <input type="number" step="0.1" name="salinity" placeholder="16.5"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_lang'">
            </div>
            <div>
                <label class="block mb-1">pH</label>
                <input type="number" step="0.1" name="ph" placeholder="7.9"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_lang'">
            </div>
            <div>
                <label class="block mb-1">Độ Trong (cm)</label>
                <input type="number" step="0.1" name="transparency" placeholder="45"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'ao_lang'">
            </div>
        </div>
    </div>

    <!-- Fields for Cau Cap -->
    <div x-show="activeTab === 'cau_cap'" class="space-y-4">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block mb-1">Mực Nước (m)</label>
                <input type="number" step="0.01" name="water_level" placeholder="1.85"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'cau_cap'">
            </div>
            <div>
                <label class="block mb-1">Đỉnh Thủy Triều (m)</label>
                <input type="number" step="0.01" name="tidal_peak" placeholder="2.1"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'cau_cap'">
            </div>
            <div>
                <label class="block mb-1">Độ Mặn (ppt)</label>
                <input type="number" step="0.1" name="salinity" placeholder="14.5"
                    class="w-full bg-white border border-slate-200 p-2.5 rounded-xl"
                    :disabled="activeTab !== 'cau_cap'">
            </div>
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
