<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quản lý khu nuôi
        </h2>
    </x-slot>

    <!-- Main Container under Alpine.js -->
    <div x-data="{ 
        showModal: false, 
        isEdit: false, 
        modalData: { id: '', code: '', name: '', total_area: '', location: '' },
        openCreateModal() {
            this.isEdit = false;
            this.modalData = { id: '', code: '', name: '', total_area: '', location: '' };
            this.showModal = true;
        },
        openEditModal(zone) {
            this.isEdit = true;
            this.modalData = { ...zone };
            this.showModal = true;
        }
    }" class="py-6 px-8 space-y-6">

        <!-- Top Overview Stats -->
        <div class="grid grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tổng số khu nuôi</span>
                    <span class="text-3xl font-black text-slate-900 mt-1 block">2</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ao đang nuôi tôm</span>
                    <span class="text-3xl font-black text-emerald-600 mt-1 block">5</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ao đang cải tạo</span>
                    <span class="text-3xl font-black text-amber-500 mt-1 block">3</span>
                </div>
                <div class="p-3 bg-amber-50 text-amber-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    </svg>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ao đang trống</span>
                    <span class="text-3xl font-black text-slate-500 mt-1 block">1</span>
                </div>
                <div class="p-3 bg-slate-50 text-slate-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Section Header -->
        <div class="flex items-center justify-between mt-8">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Danh sách phân khu nuôi</h3>
                <p class="text-xs text-slate-500 mt-0.5">Quản lý và theo dõi thông tin chi tiết từng phân khu và ao nuôi trực thuộc</p>
            </div>
            <button @click="openCreateModal()" 
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl hover:shadow-lg hover:shadow-emerald-500/10 transition-all flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Thêm khu nuôi</span>
            </button>
        </div>

        <!-- Zones List with Collapsible Ponds Accordion -->
        <div class="space-y-6">
            @foreach($farmingZones as $zone)
                <div x-data="{ isOpen: true }" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden transition-all">
                    <!-- Zone Card Header -->
                    <div class="p-6 bg-slate-50/60 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-white border border-slate-200 rounded-xl shadow-sm">
                                <span class="text-xs font-black text-slate-800 uppercase tracking-widest">{{ $zone['code'] }}</span>
                            </div>
                            <div>
                                <h4 class="text-md font-bold text-slate-900">{{ $zone['name'] }}</h4>
                                <div class="flex items-center space-x-3 mt-1 text-xs text-slate-500">
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                        {{ $zone['location'] }}
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4M4 4l5 5m11 7v4m0 0h-4m4 0l-5-5"></path>
                                        </svg>
                                        Diện tích: {{ number_format($zone['total_area']) }} m²
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Aggregate Badges -->
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm text-xs font-semibold">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 block"></span>
                                <span class="text-slate-600">{{ $zone['rearing_ponds_count'] }} Đang nuôi</span>
                            </div>
                            <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm text-xs font-semibold">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 block"></span>
                                <span class="text-slate-600">{{ $zone['rehabilitating_ponds_count'] }} Cải tạo</span>
                            </div>
                            @if($zone['empty_ponds_count'] > 0)
                                <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm text-xs font-semibold">
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-400 block"></span>
                                    <span class="text-slate-600">{{ $zone['empty_ponds_count'] }} Trống</span>
                                </div>
                            @endif

                            <!-- Accordion & Actions -->
                            <div class="flex items-center space-x-2 border-l border-slate-200 pl-4 ml-2">
                                <button @click="openEditModal({{ json_encode($zone) }})" 
                                        type="button" 
                                        class="p-2 hover:bg-slate-200/60 text-slate-500 hover:text-slate-900 rounded-lg transition-colors"
                                        title="Chỉnh sửa">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <button @click="isOpen = !isOpen" 
                                        type="button" 
                                        class="p-2 hover:bg-slate-200/60 text-slate-500 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 transform transition-transform duration-200" 
                                         :class="isOpen ? 'rotate-180' : ''" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Collapsible Ponds Table -->
                    <div x-show="isOpen" x-collapse>
                        <div class="border-t border-slate-100">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50/40 text-slate-400 font-bold text-[10px] uppercase tracking-wider border-b border-slate-100">
                                            <th class="py-4 px-6">Mã ao</th>
                                            <th class="py-4 px-6">Tên ao</th>
                                            <th class="py-4 px-6">Loại ao</th>
                                            <th class="py-4 px-6 text-right">Kích thước ao (Miệng/Đáy/Bờ)</th>
                                            <th class="py-4 px-6 text-right">Diện tích đáy ao</th>
                                            <th class="py-4 px-6 text-center">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-sm">
                                        @foreach($zone['ponds'] as $pond)
                                            <tr class="hover:bg-slate-50/30 transition-colors">
                                                <td class="py-4 px-6 font-bold text-slate-900">{{ $pond['code'] }}</td>
                                                <td class="py-4 px-6 text-slate-700 font-medium">{{ $pond['name'] }}</td>
                                                <td class="py-4 px-6">
                                                    @if($pond['pond_type'] === 'nursery')
                                                        <span class="px-2.5 py-1 text-[11px] font-bold text-blue-700 bg-blue-50 border border-blue-100 rounded-lg uppercase tracking-wider">Ao gièo (ươm)</span>
                                                    @else
                                                        <span class="px-2.5 py-1 text-[11px] font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-lg uppercase tracking-wider">Ao thương phẩm</span>
                                                    @endif
                                                </td>
                                                <td class="py-4 px-6 text-right text-slate-500 font-mono">
                                                    {{ number_format($pond['mouth_diameter'], 1) }}m / {{ number_format($pond['bottom_diameter'], 1) }}m / {{ number_format($pond['border_exclusion'], 1) }}m
                                                </td>
                                                <td class="py-4 px-6 text-right font-bold text-slate-900 font-mono">
                                                    {{ number_format($pond['area'], 2) }} m²
                                                </td>
                                                <td class="py-4 px-6 text-center">
                                                    @if($pond['status'] === 'rearing')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-500 block"></span>
                                                            Đang nuôi
                                                        </span>
                                                    @elseif($pond['status'] === 'rehabilitating')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-500 block"></span>
                                                            Cải tạo ao
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-50 text-slate-600 border border-slate-200">
                                                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-slate-400 block"></span>
                                                            Ao trống
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Alpine.js Create / Edit Modal Popup -->
        <div x-show="showModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <!-- Modal Body -->
            <div @click.away="showModal = false" 
                 class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Modal Title -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                    <h3 class="text-lg font-bold text-slate-900" x-text="isEdit ? 'Chỉnh sửa thông tin khu nuôi' : 'Thêm khu nuôi mới'"></h3>
                    <button @click="showModal = false" class="p-1.5 hover:bg-slate-100 text-slate-400 hover:text-slate-950 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Simulating post form / Hardcoded fields -->
                <form @submit.prevent="showModal = false; alert('Giao diện tĩnh đã sẵn sàng. API sẽ được bổ sung sau!')" class="space-y-4">
                    <!-- Code -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Mã khu nuôi</label>
                        <input type="text" x-model="modalData.code" placeholder="Ví dụ: ZONE-C" required
                               class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Tên khu nuôi</label>
                        <input type="text" x-model="modalData.name" placeholder="Ví dụ: Khu Nuôi Cánh Bắc" required
                               class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                    </div>

                    <!-- Total Area -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Diện tích tổng (m²)</label>
                        <input type="number" x-model="modalData.total_area" placeholder="Ví dụ: 45000" required
                               class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">Vị trí địa lý</label>
                        <input type="text" x-model="modalData.location" placeholder="Ví dụ: Phía Bắc trạm bơm" 
                               class="w-full bg-slate-50 border border-slate-200 p-3 text-sm focus:outline-none focus:bg-white focus:border-[#16a34a] focus:ring-4 focus:ring-emerald-500/10 rounded-lg transition-all">
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

    </div>
</x-app-layout>
