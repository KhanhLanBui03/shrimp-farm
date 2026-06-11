<form method="POST" action="{{ route('cultivation-cycles.store') }}"
    class="space-y-4 text-xs font-semibold text-slate-700">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Mã vụ nuôi *</label>
            <input type="text" name="code" placeholder="VU-2026-X" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
        </div>
        <div>
            <label class="block mb-1">Tên vụ nuôi *</label>
            <input type="text" name="name" placeholder="Vụ Hè Thu 2026" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4" x-data="{ startDate: '{{ date('Y-m-d') }}' }">
        <div>
            <label class="block mb-1">Ngày bắt đầu *</label>
            <input type="date" name="start_date" required x-model="startDate"
                min="{{ date('Y-m-d') }}"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
        </div>
        <div>
            <label class="block mb-1">Ngày kết thúc dự kiến</label>
            <input type="date" name="expected_end_date" :min="startDate"
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-1">Trạng thái *</label>
            <select name="status" required
                class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
                <option value="planning">Lập kế hoạch</option>
                <option value="active">Đang hoạt động</option>
                <option value="completed">Đã hoàn thành</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Ao tham gia vụ này *</label>
            @if(isset($allPonds) && count($allPonds) > 0)
                <div class="relative" x-data="{ 
                            open: false, 
                            search: '',
                            selected: [],
                            ponds: [
                                @foreach($allPonds as $pond)
                                    { id: '{{ $pond->id }}', name: '{{ $pond->name }}', type: '{{ $pond->pond_type === 'nursery' ? 'Ao gièo' : 'Ao nuôi' }}' }{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            ],
                            get filteredPonds() {
                                if (!this.search) return this.ponds;
                                return this.ponds.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()) || p.type.toLowerCase().includes(this.search.toLowerCase()));
                            },
                            get selectedLabel() {
                                if (this.selected.length === 0) return 'Chọn ao nuôi...';
                                const names = this.ponds
                                    .filter(p => this.selected.map(String).includes(String(p.id)))
                                    .map(p => p.name);
                                if (names.length <= 2) {
                                    return names.join(', ');
                                }
                                return `Đã chọn ${names.length} ao`;
                            }
                        }" @click.away="open = false">
                    <!-- Trigger Button -->
                    <button type="button" @click="open = !open"
                        class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500 flex justify-between items-center text-left text-slate-700 shadow-sm hover:border-slate-300 transition-colors">
                        <span class="truncate text-xs font-semibold" x-text="selectedLabel"></span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 flex-shrink-0 ml-1.5"
                            :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Hidden Input for HTML5 Validation -->
                    <input type="text" class="sr-only" :value="selected.length ? 'selected' : ''" required
                        oninvalid="this.setCustomValidity('Vui lòng chọn ít nhất một ao nuôi')"
                        oninput="this.setCustomValidity('')">

                    <!-- Dropdown Panel -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute z-50 w-full mt-1.5 bg-white border border-slate-200 rounded-xl shadow-xl p-2.5"
                        x-cloak>
                        <!-- Search Input (Fixed at top) -->
                        <div class="mb-2">
                            <input type="text" x-model="search" placeholder="Tìm kiếm ao..."
                                class="w-full bg-slate-50 border border-slate-200 px-3 py-2 rounded-lg text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                        <!-- Scrollable Ponds List -->
                        <div class="max-h-48 overflow-y-auto space-y-0.5 custom-scrollbar pr-1">
                            <template x-for="pond in filteredPonds" :key="pond.id">
                                <label
                                    class="flex items-center px-2.5 py-2 hover:bg-slate-50 rounded-lg cursor-pointer transition-colors space-x-2.5">
                                    <input type="checkbox" name="pond_ids[]" :value="pond.id"
                                        x-model="selected"
                                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 w-4 h-4 transition-all">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-slate-700"
                                            x-text="pond.name"></span>
                                        <span class="text-[10px] text-slate-400" x-text="pond.type"></span>
                                    </div>
                                </label>
                            </template>
                            <div x-show="filteredPonds.length === 0"
                                class="text-center py-4 text-slate-400 italic text-xs">
                                Không tìm thấy ao nào
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl text-center">
                    <p class="text-slate-400 italic text-[10px]">Chưa có dữ liệu ao nuôi</p>
                </div>
            @endif
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
