<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quản lý thu hoạch
        </h2>
    </x-slot>

    <!-- Main Outer Wrapper under Alpine.js -->
    <div x-data="{
        showModal: false,
        isEdit: false,
        
        // Form Data
        modalData: {
            id: '',
            cultivation_cycle_id: '{{ $allCycles->first()->id ?? "" }}',
            pond_id: '{{ $allPonds->first()->id ?? "" }}',
            harvest_date: '{{ date("Y-m-d") }}',
            doc: 90,
            harvest_type: 'partial',
            shrimp_condition: 'alive',
            weight: 0,
            quantity: 0,
            size_range: '',
            unit_price: 0,
            net_rental_fee: 0
        },

        // Open Dialog Modal
        openCreateModal() {
            this.isEdit = false;
            this.modalData = {
                id: '',
                cultivation_cycle_id: '{{ $allCycles->first()->id ?? "" }}',
                pond_id: '{{ $allPonds->first()->id ?? "" }}',
                harvest_date: '{{ date("Y-m-d") }}',
                doc: 90,
                harvest_type: 'partial',
                shrimp_condition: 'alive',
                weight: 0,
                quantity: 0,
                size_range: '',
                unit_price: 0,
                net_rental_fee: 0
            };
            this.showModal = true;
        },
        openEditModal(harvest) {
            this.isEdit = true;
            this.modalData = { 
                id: harvest.id,
                cultivation_cycle_id: harvest.cultivation_cycle_id,
                pond_id: harvest.pond_id,
                harvest_date: harvest.harvest_date,
                doc: harvest.doc,
                harvest_type: harvest.harvest_type,
                shrimp_condition: harvest.shrimp_condition,
                weight: harvest.weight,
                quantity: harvest.quantity,
                size_range: harvest.size_range || '',
                unit_price: harvest.unit_price,
                net_rental_fee: harvest.net_rental_fee || 0
            };
            this.showModal = true;
        }
    }" 
    class="py-6 px-4 md:px-8 space-y-6">

        <!-- Notification messages -->
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-200" role="alert">
                <span class="font-bold">Thành công!</span> {{ session('success') }}
            </div>
        @endif

        <!-- Metrics Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tổng sản lượng thu hoạch</span>
                    <span class="text-2xl font-black text-slate-900 mt-1 block">{{ number_format($items->sum('weight'), 1) }} kg</span>
                </div>
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Doanh thu tạm tính</span>
                    <span class="text-2xl font-black text-emerald-600 mt-1 block">{{ number_format($items->sum('total_amount')) }}đ</span>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Phí thuê tay lưới</span>
                    <span class="text-2xl font-black text-rose-600 mt-1 block">{{ number_format($items->sum('net_rental_fee')) }}đ</span>
                </div>
                <div class="p-3 bg-rose-50 text-rose-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Thực thu (Doanh thu thuần)</span>
                    <span class="text-2xl font-black text-blue-600 mt-1 block">{{ number_format($items->sum('net_amount')) }}đ</span>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Section Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Danh sách các đợt thu hoạch</h3>
                <p class="text-xs text-slate-500 mt-0.5">Quản lý, chỉnh sửa, và theo dõi sản lượng thu hoạch tôm định kỳ hoặc cuối vụ</p>
            </div>
            <button @click="openCreateModal()" 
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl hover:shadow-lg hover:shadow-emerald-500/10 transition-all flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Ghi nhận thu hoạch</span>
            </button>
        </div>

        <!-- Harvests Table -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/60 text-slate-400 font-bold text-[10px] uppercase tracking-wider border-b border-slate-100 whitespace-nowrap">
                            <th class="py-4 px-6">Mã thu hoạch</th>
                            <th class="py-4 px-6">Vụ nuôi</th>
                            <th class="py-4 px-6">Ao nuôi</th>
                            <th class="py-4 px-6">Ngày thu hoạch</th>
                            <th class="py-4 px-6 text-center">Tuổi tôm (DOC)</th>
                            <th class="py-4 px-6">Hình thức</th>
                            <th class="py-4 px-6">Tình trạng</th>
                            <th class="py-4 px-6 text-right">Khối lượng</th>
                            <th class="py-4 px-6 text-right">Kích cỡ (Size)</th>
                            <th class="py-4 px-6 text-right">Thực nhận</th>
                            <th class="py-4 px-6 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($items as $item)
                            <tr class="hover:bg-slate-50/20 transition-all whitespace-nowrap">
                                <td class="py-4 px-6 font-mono font-bold text-slate-900">TH-{{ $item->id }}</td>
                                <td class="py-4 px-6 font-semibold text-slate-700">{{ $item->cultivationCycle->name ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-indigo-600 font-bold">{{ $item->pond->name ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-slate-500 font-semibold">
                                    {{ \Carbon\Carbon::parse($item->harvest_date)->format('d/m/Y') }}
                                </td>
                                <td class="py-4 px-6 text-center font-mono font-bold text-slate-800">{{ $item->doc }} ngày</td>
                                <td class="py-4 px-6">
                                    @if($item->harvest_type === 'total')
                                        <span class="px-2 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-100 rounded uppercase tracking-wider whitespace-nowrap">Thu toàn bộ</span>
                                    @else
                                        <span class="px-2 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-50 border border-amber-100 rounded uppercase tracking-wider whitespace-nowrap">Thu tỉa bớt</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if($item->shrimp_condition === 'alive')
                                        <span class="text-xs text-emerald-600 font-bold whitespace-nowrap">● Tôm sống</span>
                                    @elseif($item->shrimp_condition === 'substandard')
                                        <span class="text-xs text-amber-600 font-bold whitespace-nowrap">● Tôm ke/dạt</span>
                                    @else
                                        <span class="text-xs text-rose-600 font-bold whitespace-nowrap">● Tôm ngộp/chết</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-slate-900 font-mono">
                                    {{ number_format($item->weight, 1) }} kg
                                </td>
                                <td class="py-4 px-6 text-right font-semibold text-slate-600">
                                    {{ $item->size_range ?? 'N/A' }}
                                </td>
                                <td class="py-4 px-6 text-right font-black text-slate-900 font-mono">
                                    {{ number_format($item->net_amount) }}đ
                                    <div class="text-[9px] text-slate-400 font-semibold mt-0.5">Phí lưới: {{ number_format($item->net_rental_fee) }}đ</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Edit button -->
                                        <button @click="openEditModal({{ json_encode($item) }})" 
                                                type="button" 
                                                class="p-1.5 text-slate-500 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </button>

                                        <!-- Delete button -->
                                        <form action="{{ route('harvests.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đợt thu hoạch này?')" class="inline">
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
                        @empty
                            <tr>
                                <td colspan="11" class="py-12 text-center text-slate-400 font-semibold">
                                    Không có dữ liệu thu hoạch nào được tìm thấy. Vui lòng bấm thêm mới ở trên.
                                </td>
                            </tr>
                        @endforelse
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
                 class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 transform transition-all overflow-y-auto max-h-[85vh]"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                    <h3 class="text-lg font-bold text-slate-900" x-text="isEdit ? 'Chỉnh sửa đợt thu hoạch' : 'Ghi nhận đợt thu hoạch mới'"></h3>
                    <button @click="showModal = false" class="p-1.5 hover:bg-slate-100 text-slate-400 hover:text-slate-950 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="POST" :action="isEdit ? '/harvests/' + modalData.id : '{{ route('harvests.store') }}'" class="space-y-4 text-xs font-semibold text-slate-700">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">Vụ nuôi *</label>
                            <select name="cultivation_cycle_id" x-model="modalData.cultivation_cycle_id" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                                @foreach($allCycles as $cycle)
                                    <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1">Ao thu hoạch *</label>
                            <select name="pond_id" x-model="modalData.pond_id" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                                @foreach($allPonds as $pond)
                                    <option value="{{ $pond->id }}">{{ $pond->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block mb-1">Ngày thu hoạch *</label>
                            <input type="date" name="harvest_date" x-model="modalData.harvest_date" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <div>
                            <label class="block mb-1">Tuổi tôm DOC *</label>
                            <input type="number" name="doc" x-model="modalData.doc" placeholder="90" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <div>
                            <label class="block mb-1">Hình thức thu *</label>
                            <select name="harvest_type" x-model="modalData.harvest_type" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                                <option value="partial">Thu tỉa bớt</option>
                                <option value="total">Thu toàn bộ</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block mb-1">Khối lượng (kg) *</label>
                            <input type="number" step="0.1" name="weight" x-model="modalData.weight" placeholder="4200" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <div>
                            <label class="block mb-1">Số lượng (con) *</label>
                            <input type="number" name="quantity" x-model="modalData.quantity" placeholder="160000" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <div>
                            <label class="block mb-1">Tình trạng tôm *</label>
                            <select name="shrimp_condition" x-model="modalData.shrimp_condition" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                                <option value="alive">Tôm sống</option>
                                <option value="substandard">Tôm ke/dạt</option>
                                <option value="dead">Tôm ngộp/chết</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block mb-1">Kích cỡ Size (con/kg)</label>
                            <input type="text" name="size_range" x-model="modalData.size_range" placeholder="38 con/kg"
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <div>
                            <label class="block mb-1">Đơn giá bán (đ/kg) *</label>
                            <input type="number" name="unit_price" x-model="modalData.unit_price" placeholder="160000" required
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                        <div>
                            <label class="block mb-1">Phí thuê tay lưới (đ)</label>
                            <input type="number" name="net_rental_fee" x-model="modalData.net_rental_fee"
                                class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        </div>
                    </div>

                    <!-- Calculated summary values -->
                    <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-[10px] font-bold text-indigo-400 uppercase block">Doanh thu tạm tính</span>
                            <span class="text-sm font-black text-slate-800 font-mono mt-0.5 block" x-text="new Intl.NumberFormat('vi-VN').format(modalData.weight * modalData.unit_price) + ' đ'"></span>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-indigo-400 uppercase block">Thực thu (Doanh thu thuần)</span>
                            <span class="text-sm font-black text-indigo-600 font-mono mt-0.5 block" x-text="new Intl.NumberFormat('vi-VN').format(Math.max(0, (modalData.weight * modalData.unit_price) - (modalData.net_rental_fee || 0))) + ' đ'"></span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-3 justify-end pt-4 border-t border-slate-100">
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
