<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quản lý ao nuôi
        </h2>
    </x-slot>

    <!-- Main Outer Wrapper under Alpine.js -->
    <div x-data="{
        showModal: false,
        isEdit: false,
        showHistoryDrawer: false,
        activeHistoryPond: null,
        activeHistoryLogs: [],
        
        // Form Data
        modalData: {
            id: '',
            code: '',
            name: '',
            farming_zone_id: '{{ $farmingZones->first()["id"] ?? "" }}',
            mouth_diameter: 30,
            border_exclusion: 2,
            bottom_diameter: 28,
            area: 615.75,
            pond_type: 'rearing',
            status: 'empty'
        },

        // Open Dialog Modal
        openCreateModal() {
            this.isEdit = false;
            this.modalData = {
                id: '',
                code: '',
                name: '',
                farming_zone_id: '{{ $farmingZones->first()["id"] ?? "" }}',
                mouth_diameter: 30,
                border_exclusion: 2,
                bottom_diameter: 28,
                area: 615.75,
                pond_type: 'rearing',
                status: 'empty'
            };
            this.showModal = true;
        },
        openEditModal(pond) {
            this.isEdit = true;
            this.modalData = { ...pond };
            this.showModal = true;
        },

        // History Drawer Control
        openHistoryDrawer(pond) {
            this.activeHistoryPond = pond.name + ' (' + pond.code + ')';
            this.activeHistoryLogs = pond.history || [];
            this.showHistoryDrawer = true;
        }
    }" 
    x-effect="
        let md = parseFloat(modalData.mouth_diameter) || 0;
        let be = parseFloat(modalData.border_exclusion) || 0;
        modalData.bottom_diameter = Math.max(0, md - be).toFixed(2);
        modalData.area = (Math.PI * Math.pow((modalData.bottom_diameter / 2), 2)).toFixed(2);
    "
    class="py-6 px-4 md:px-8 space-y-6">

        <!-- Metrics Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tổng số ao nuôi</span>
                    <span class="text-3xl font-black text-slate-900 mt-1 block">{{ count($ponds) }}</span>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ao thương phẩm</span>
                    <span class="text-3xl font-black text-emerald-600 mt-1 block">{{ $ponds->where('pond_type', 'rearing')->count() }}</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ao gièo (ươm)</span>
                    <span class="text-3xl font-black text-blue-600 mt-1 block">{{ $ponds->where('pond_type', 'nursery')->count() }}</span>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ao đang trống</span>
                    <span class="text-3xl font-black text-amber-500 mt-1 block">{{ $ponds->where('status', 'empty')->count() }}</span>
                </div>
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Section Header Actions -->
        <div class="flex items-center justify-between mt-8">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Thông tin ao nuôi</h3>
                <p class="text-xs text-slate-500 mt-0.5">Danh sách toàn bộ ao nuôi, kích thước tính toán thực tế và lịch sử thả vụ</p>
            </div>
            <button @click="openCreateModal()" 
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl hover:shadow-lg hover:shadow-emerald-500/10 transition-all flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Thêm ao nuôi</span>
            </button>
        </div>

        <!-- Ponds Table -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/60 text-slate-400 font-bold text-[10px] uppercase tracking-wider border-b border-slate-100 whitespace-nowrap">
                            <th class="py-4 px-6">Mã ao</th>
                            <th class="py-4 px-6">Tên ao</th>
                            <th class="py-4 px-6">Khu nuôi trực thuộc</th>
                            <th class="py-4 px-6">Loại ao</th>
                            <th class="py-4 px-6 text-right">Kích thước (Miệng/Đáy/Bờ)</th>
                            <th class="py-4 px-6 text-right">Diện tích đáy</th>
                            <th class="py-4 px-6 text-center">Trạng thái</th>
                            <th class="py-4 px-6 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($ponds as $pond)
                            <tr class="hover:bg-slate-50/20 transition-all whitespace-nowrap">
                                <td class="py-4 px-6 font-bold text-slate-900 whitespace-nowrap">{{ $pond['code'] }}</td>
                                <td class="py-4 px-6 font-semibold text-slate-700 whitespace-nowrap">{{ $pond['name'] }}</td>
                                <td class="py-4 px-6 text-slate-500 whitespace-nowrap">{{ $pond['farming_zone'] }}</td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    @if($pond['pond_type'] === 'nursery')
                                        <span class="px-2 py-0.5 text-[10px] font-bold text-blue-700 bg-blue-50 border border-blue-100 rounded uppercase tracking-wider whitespace-nowrap">Ao gièo (ươm)</span>
                                    @else
                                        <span class="px-2 py-0.5 text-[10px] font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 rounded uppercase tracking-wider whitespace-nowrap">Thương phẩm</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right font-mono text-slate-500 whitespace-nowrap">
                                    {{ number_format($pond['mouth_diameter'], 1) }}m / {{ number_format($pond['bottom_diameter'], 1) }}m / {{ number_format($pond['border_exclusion'], 1) }}m
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-slate-900 font-mono whitespace-nowrap">
                                    {{ number_format($pond['area'], 2) }} m²
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    @if($pond['status'] === 'rearing')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span>
                                            Đang nuôi
                                        </span>
                                    @elseif($pond['status'] === 'rehabilitating')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span>
                                            Cải tạo ao
                                        </span>
                                    @elseif($pond['status'] === 'ready')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-blue-500 rounded-full"></span>
                                            Sẵn sàng thả
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-50 text-slate-500 border border-slate-200">
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-slate-400 rounded-full"></span>
                                            Ao trống
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- History button -->
                                        <button @click="openHistoryDrawer({{ json_encode($pond) }})" 
                                                type="button" 
                                                class="px-2.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-xs text-slate-700 font-semibold rounded-lg transition-colors flex items-center space-x-1">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>Lịch sử vụ</span>
                                        </button>

                                        <!-- Edit button -->
                                        <button @click="openEditModal({{ json_encode($pond) }})" 
                                                type="button" 
                                                class="p-1.5 text-slate-500 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </button>

                                        <!-- Delete button -->
                                        <form action="{{ route('ponds.destroy', $pond['id']) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa ao này?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Alpine.js Create / Edit Modal -->
        <div x-show="showModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <div @click.away="showModal = false" 
                 class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 transform transition-all overflow-hidden"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                    <h3 class="text-lg font-bold text-slate-900" x-text="isEdit ? 'Chỉnh sửa ao nuôi' : 'Thêm ao nuôi mới'"></h3>
                    <button @click="showModal = false" class="p-1.5 hover:bg-slate-100 text-slate-400 hover:text-slate-950 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="POST" :action="isEdit ? '/ponds/' + modalData.id : '{{ route('ponds.store') }}'" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Mã ao nuôi</label>
                            <input type="text" name="code" x-model="modalData.code" placeholder="Ví dụ: A-06" required
                                   class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Tên ao nuôi</label>
                            <input type="text" name="name" x-model="modalData.name" placeholder="Ví dụ: Ao Rearing 06" required
                                   class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Khu nuôi trực thuộc</label>
                            <select name="farming_zone_id" x-model="modalData.farming_zone_id" required
                                    class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                                @foreach($farmingZones as $zone)
                                    <option value="{{ $zone['id'] }}">{{ $zone['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Loại ao nuôi</label>
                            <select name="pond_type" x-model="modalData.pond_type" required
                                    class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                                <option value="rearing">Ao nuôi thương phẩm</option>
                                <option value="nursery">Ao gièo (ươm giống)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dimension Inputs & Dynamically computed fields -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-4">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kích thước & Tính toán diện tích</h4>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1.5 uppercase">Đường kính miệng (m)</label>
                                <input type="number" step="0.1" name="mouth_diameter" x-model="modalData.mouth_diameter" required
                                       class="w-full bg-white border border-slate-200 p-2.5 text-sm focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-emerald-500/10 rounded-lg transition-all">
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 mb-1.5 uppercase">Khoảng trừ bờ (m)</label>
                                <input type="number" step="0.1" name="border_exclusion" x-model="modalData.border_exclusion" required
                                       class="w-full bg-white border border-slate-200 p-2.5 text-sm focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-emerald-500/10 rounded-lg transition-all">
                            </div>
                        </div>

                        <!-- Computed display read-only -->
                        <div class="grid grid-cols-2 gap-4 pt-2 border-t border-slate-200/60">
                            <div>
                                <span class="text-[10px] font-bold text-slate-500 uppercase block">Đường kính đáy ao (tự tính)</span>
                                <span class="text-md font-extrabold text-slate-900 font-mono mt-0.5 block" x-text="modalData.bottom_diameter + ' m'"></span>
                            </div>

                            <div>
                                <span class="text-[10px] font-bold text-slate-500 uppercase block">Diện tích đáy ao (tự tính)</span>
                                <span class="text-md font-extrabold text-emerald-600 font-mono mt-0.5 block" x-text="modalData.area + ' m²'"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Trạng thái ao nuôi</label>
                        <select name="status" x-model="modalData.status" required
                                class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                            <option value="empty">Ao trống</option>
                            <option value="rehabilitating">Cải tạo ao</option>
                            <option value="ready">Sẵn sàng thả</option>
                            <option value="rearing">Đang nuôi</option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-3 justify-end pt-4 border-t border-slate-100 mt-6">
                        <button @click="showModal = false" type="button"
                                class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg transition-all">
                            Hủy bỏ
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg hover:shadow-lg hover:shadow-emerald-500/20 transition-all">
                            Lưu thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alpine.js Centered Modal for Usage History -->
        <div x-show="showHistoryDrawer" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <!-- Modal Content Body -->
            <div @click.away="showHistoryDrawer = false" 
                 class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all overflow-hidden flex flex-col"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Modal Title Header -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Lịch sử vụ nuôi</h3>
                        <p class="text-xs text-slate-500 mt-0.5" x-text="'Ao nuôi: ' + activeHistoryPond"></p>
                    </div>
                    <button @click="showHistoryDrawer = false" class="p-1.5 hover:bg-slate-100 text-slate-400 hover:text-slate-950 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Inner Scroll Content -->
                <div class="flex-1 space-y-6 max-h-[50vh] overflow-y-auto pr-1">
                    <template x-if="activeHistoryLogs.length === 0">
                        <div class="py-12 text-center text-slate-400 text-sm">
                            Chưa có lịch sử vụ nuôi nào được ghi nhận cho ao này.
                        </div>
                    </template>

                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            <template x-for="(log, logIdx) in activeHistoryLogs" :key="logIdx">
                                <li>
                                    <div class="relative pb-8">
                                        <!-- Connector line -->
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-slate-100" aria-hidden="true"></span>
                                        
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex-1 min-w-0 pt-0.5">
                                                <p class="text-sm font-bold text-slate-800" x-text="log.cycle"></p>
                                                <p class="text-xs text-slate-400 mt-1" x-text="'Thời gian: ' + log.start_date + ' đến ' + log.harvest_date"></p>
                                                <div class="mt-2 flex items-center space-x-2">
                                                    <span class="text-[10px] font-bold text-slate-600 bg-slate-50 px-2 py-0.5 rounded border border-slate-200" x-text="'Sản lượng: ' + log.yield"></span>
                                                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100" x-text="log.status"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>

                <!-- Modal Action Footer -->
                <div class="flex justify-end pt-4 border-t border-slate-100 mt-6 shrink-0">
                    <button @click="showHistoryDrawer = false" type="button"
                            class="px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-slate-900 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg transition-all">
                        Đóng
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
