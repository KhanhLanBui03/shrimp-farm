@php
    // Fetch lookup data for select dropdowns in modals
    $allPonds = \App\Models\Pond::all();
    $allSuppliers = \App\Models\Supplier::all();
    $allCycles = \App\Models\CultivationCycle::orderBy('start_date', 'desc')->get();
    $allCustomers = \App\Models\Customer::all();
    $allHarvests = \App\Models\Harvest::with('pond')->latest()->get();
    $allZones = \App\Models\FarmingZone::all();

    // Determine configuration based on title
    $config = match ($title) {
        'Quản lý vụ nuôi' => [
            'stats' => [
                ['label' => 'Vụ đang hoạt động', 'value' => $allCycles->where('status', 'active')->count() . ' Vụ nuôi', 'desc' => 'Tăng trưởng tốt'],
                ['label' => 'Diện tích mặt nước', 'value' => '12.500 m²', 'desc' => 'Tỉ lệ lấp đầy 85%'],
                ['label' => 'Tổng số ao tham gia', 'value' => $allPonds->count() . ' Ao nuôi', 'desc' => 'Gồm 2 ao gièo'],
                ['label' => 'Sản lượng dự kiến', 'value' => '35,7 Tấn', 'desc' => 'Dự kiến thu hoạch T8']
            ],
            'columns' => ['Mã Vụ', 'Tên Vụ Nuôi', 'Số Ao Thao Tác', 'Ngày Bắt Đầu', 'Dự Kiến Thu Hoạch', 'Trạng Thái'],
            'rows' => []
        ],
        'Quản lý thả giống' => [
            'stats' => [
                ['label' => 'Tổng lượng giống thả', 'value' => '1,2 Triệu con', 'desc' => 'Thả mật độ cao'],
                ['label' => 'Mật độ trung bình', 'value' => '120 con/m²', 'desc' => 'Đạt chuẩn CNC'],
                ['label' => 'Nhà cung cấp giống', 'value' => $allSuppliers->count() . ' Đối tác', 'desc' => 'Đã qua kiểm dịch'],
                ['label' => 'Tỉ lệ sống ban đầu', 'value' => '98%', 'desc' => 'Đo sau 15 ngày thả']
            ],
            'columns' => ['Mã Lô Giống', 'Nhà Cung Cấp', 'Số Lượng Thả', 'Mật Độ', 'Ao Chỉ Định', 'Ngày Thả', 'Tình Trạng'],
            'rows' => []
        ],
        'Nhật ký kỹ thuật ao' => [
            'stats' => [
                ['label' => 'Nhật ký kỹ thuật', 'value' => 'Hoạt động tốt', 'desc' => 'Cập nhật bởi KTV'],
                ['label' => 'Lượng ăn hôm nay', 'value' => '320 kg', 'desc' => 'Thức ăn dạng hạt chìm'],
                ['label' => 'Trọng lượng TB tôm', 'value' => '12,5 g', 'desc' => 'Tăng trưởng tốt'],
                ['label' => 'Số lần Xiphong', 'value' => '3 Lần/ngày', 'desc' => 'Vệ sinh đáy ao tốt']
            ],
            'columns' => ['Thời Gian', 'Ao Nuôi', 'Lượng Thức Ăn', 'Trọng Lượng TB', 'Tỉ Lệ Sống Ước Tính', 'Ghi Chú Kỹ Thuật'],
            'rows' => []
        ],
        'Quản lý chỉ số nước' => [
            'stats' => [
                ['label' => 'Lần cập nhật cuối', 'value' => '10 Phút trước', 'desc' => 'Đo tự động + thủ công'],
                ['label' => 'Ao đạt chuẩn', 'value' => '6/8 Ao nuôi', 'desc' => 'Nhiệt độ, pH ổn định'],
                ['label' => 'Cảnh báo chỉ số', 'value' => '2 Ao nuôi', 'desc' => 'Khí độc NH3 cao nhẹ'],
                ['label' => 'Oxy hòa tan TB', 'value' => '5.2 mg/L', 'desc' => 'Ngưỡng an toàn (>4.5)']
            ],
            'columns' => [],
            'rows' => []
        ],
        'Vật tư & Kho' => [
            'stats' => [
                ['label' => 'Tổng mặt hàng tồn', 'value' => '24 Sản phẩm', 'desc' => 'Thức ăn, hóa chất, thiết bị'],
                ['label' => 'Tổng giá trị tồn kho', 'value' => '185.000.000đ', 'desc' => 'Kiểm kê thường xuyên'],
                ['label' => 'Cảnh báo sắp hết', 'value' => '3 Mặt hàng', 'desc' => 'Dưới định mức tối thiểu'],
                ['label' => 'Số lượt xuất kho', 'value' => '14 Lượt/tuần', 'desc' => 'Phục vụ vụ nuôi']
            ],
            'columns' => ['Tên Vật Tư', 'Phân Loại', 'Số Lượng Tồn', 'Đơn Vị', 'Đơn Giá', 'Tình Trạng'],
            'rows' => []
        ],
        'Nhà cung cấp' => [
            'stats' => [
                ['label' => 'Tổng nhà cung cấp', 'value' => $allSuppliers->count() . ' Đối tác', 'desc' => 'Trong nước & Nhập khẩu'],
                ['label' => 'Tổng công nợ hiện tại', 'value' => number_format($allSuppliers->sum('debt')) . 'đ', 'desc' => 'Kỳ hạn thanh toán T6'],
                ['label' => 'Tỉ lệ giao đúng hẹn', 'value' => '98%', 'desc' => 'Đánh giá chất lượng vận chuyển'],
                ['label' => 'Đã ký hợp đồng', 'value' => '5 Doanh nghiệp', 'desc' => 'Giá ưu đãi dài hạn']
            ],
            'columns' => ['Tên Nhà Cung Cấp', 'Danh Mục Cung Cấp', 'Số Điện Thoại', 'Địa Chỉ Liên Hệ', 'STK Ngân Hàng', 'Công Nợ'],
            'rows' => []
        ],
        'Quản lý thu hoạch' => [
            'stats' => [
                ['label' => 'Đã thu hoạch', 'value' => '12,8 Tấn', 'desc' => 'Vụ nuôi 2026'],
                ['label' => 'Kích cỡ trung bình', 'value' => '45 con/kg', 'desc' => 'Tôm thương phẩm loại 1'],
                ['label' => 'Doanh thu tạm tính', 'value' => '1,92 Tỷ VND', 'desc' => 'Thương lái chốt giá'],
                ['label' => 'Tỉ lệ hao hụt', 'value' => '8%', 'desc' => 'Ngưỡng cho phép (<15%)']
            ],
            'columns' => ['Mã Thu Hoạch', 'Ao Nuôi', 'Ngày Thu Hoạch', 'Sản Lượng', 'Kích Cỡ (Size)', 'Hình Thức Thu', 'Doanh Thu'],
            'rows' => []
        ],
        'Quản lý bán hàng' => [
            'stats' => [
                ['label' => 'Doanh số thực tế', 'value' => number_format($allCustomers->sum('debt')) . 'đ', 'desc' => 'Tổng giá trị hóa đơn'],
                ['label' => 'Đã thu tiền mặt/CK', 'value' => '1.050.000.000đ', 'desc' => 'Tỉ lệ thu hồi nợ cao'],
                ['label' => 'Công nợ chưa thu', 'value' => number_format($allCustomers->sum('debt')) . 'đ', 'desc' => 'Công nợ từ thương lái'],
                ['label' => 'Sản lượng đã bán', 'value' => '12.800 kg', 'desc' => 'Giá trung bình 150k/kg']
            ],
            'columns' => ['Mã Hóa Đơn', 'Khách Hàng', 'Ngày Giao Dịch', 'Tổng Tiền', 'Đã Thanh Toán', 'Còn Lại', 'Trạng Thái'],
            'rows' => []
        ],
        'Quản lý khách hàng' => [
            'stats' => [
                ['label' => 'Tổng số khách hàng', 'value' => $allCustomers->count() . ' Khách hàng', 'desc' => 'Thương lái & Doanh nghiệp'],
                ['label' => 'Sản lượng tiêu thụ', 'value' => '35 Tấn/năm', 'desc' => 'Thị trường nội địa & Xuất khẩu'],
                ['label' => 'Khách hàng VIP', 'value' => '6 Đối tác', 'desc' => 'Bao tiêu sản phẩm'],
                ['label' => 'Tổng dư nợ khách hàng', 'value' => number_format($allCustomers->sum('debt')) . 'đ', 'desc' => 'Dư nợ hiện tại']
            ],
            'columns' => ['Khách Hàng', 'Số Điện Thoại', 'Địa Bàn Thu Mua', 'STK Ngân Hàng', 'Tổng Dư Nợ', 'Trạng Thái'],
            'rows' => []
        ],
        'Chi phí vận hành' => [
            'stats' => [
                ['label' => 'Chi phí tháng này', 'value' => '142.500.000đ', 'desc' => 'Đã duyệt toàn bộ'],
                ['label' => 'Danh mục chi lớn nhất', 'value' => 'Tiền điện (45%)', 'desc' => 'Chạy quạt oxy liên tục'],
                ['label' => 'Đã thực hiện chi', 'value' => '128.000.000đ', 'desc' => 'Chuyển khoản doanh nghiệp'],
                ['label' => 'Chi phí phát sinh', 'value' => '14.500.000đ', 'desc' => 'Bảo trì sửa chữa cánh quạt']
            ],
            'columns' => ['Mã Phiếu', 'Ngày Chi', 'Danh Mục Chi', 'Chi Tiết Nghiệp Vụ', 'Số Tiền Chi', 'Phương Thức Phân Bổ'],
            'rows' => []
        ],
        default => [
            'stats' => [],
            'columns' => [],
            'rows' => []
        ]
    };

    // Populate dynamic rows from database if items collection exists
    if (isset($items) && $items->isNotEmpty()) {
        $realRows = [];
        foreach ($items as $item) {
            $realRows[] = match ($title) {
                'Quản lý vụ nuôi' => [
                    '_id' => $item->id,
                    'code' => $item->code,
                    'name' => $item->name,
                    'ponds' => $item->ponds->count() . ' Ao nuôi',
                    'start' => \Carbon\Carbon::parse($item->start_date)->format('d/m/Y'),
                    'end' => $item->expected_end_date ? \Carbon\Carbon::parse($item->expected_end_date)->format('d/m/Y') : '-',
                    'status' => $item->status === 'active' ? 'Đang nuôi' : ($item->status === 'completed' ? 'Đã thu hoạch' : 'Lập kế hoạch'),
                    'status_type' => $item->status === 'active' ? 'success' : ($item->status === 'completed' ? 'info' : 'warning')
                ],
                'Quản lý thả giống' => [
                    'code' => $item->lot_number,
                    'supplier' => $item->supplier->name ?? 'N/A',
                    'qty' => number_format($item->quantity) . ' con',
                    'density' => number_format($item->stocking_density) . ' con/m²',
                    'pond' => $item->pond->name ?? 'N/A',
                    'date' => \Carbon\Carbon::parse($item->stocking_date)->format('d/m/Y'),
                    'status' => \Carbon\Carbon::parse($item->stocking_date)->isFuture() ? 'Chờ thả' : 'Đã thả',
                    'status_type' => \Carbon\Carbon::parse($item->stocking_date)->isFuture() ? 'warning' : 'success'
                ],
                'Nhật ký kỹ thuật ao' => [
                    'time' => \Carbon\Carbon::parse($item->date)->format('d/m/Y'),
                    'pond' => $item->pond->name ?? 'N/A',
                    'feed' => number_format($item->feed_amount) . ' kg',
                    'weight' => number_format($item->shrimp_size, 1) . ' g',
                    'survival' => number_format($item->estimated_survival) . '%',
                    'note' => $item->notes ?? 'Bình thường'
                ],
                'Vật tư & Kho' => [
                    'name' => $item->name,
                    'type' => match ($item->type) {
                            'feed' => 'Thức ăn',
                            'medicine' => 'Thuốc',
                            'probiotic' => 'Vi sinh',
                            'mineral' => 'Khoáng',
                            default => 'Hóa chất'
                        },
                    'qty' => number_format($item->stock_quantity),
                    'unit' => $item->unit,
                    'unit_price' => number_format($item->unit_price) . 'đ',
                    'status' => $item->stock_quantity > 100 ? 'Còn hàng' : ($item->stock_quantity > 0 ? 'Sắp hết' : 'Hết hàng'),
                    'status_type' => $item->stock_quantity > 100 ? 'success' : ($item->stock_quantity > 0 ? 'warning' : 'danger')
                ],
                'Nhà cung cấp' => [
                    'name' => $item->name,
                    'supply' => match ($item->supply_type) {
                            'seeds' => 'Tôm giống',
                            'feed' => 'Thức ăn',
                            'materials' => 'Vật tư',
                            'chemicals' => 'Hóa chất',
                            default => 'Tổng hợp'
                        },
                    'phone' => $item->phone ?? '-',
                    'address' => $item->address ?? '-',
                    'bank' => $item->bank_account ?? '-',
                    'debt' => number_format($item->debt) . 'đ',
                ],
                'Quản lý thu hoạch' => [
                    'code' => 'TH-' . $item->id,
                    'pond' => $item->pond->name ?? 'N/A',
                    'date' => \Carbon\Carbon::parse($item->harvest_date)->format('d/m/Y'),
                    'qty' => number_format($item->weight) . ' kg',
                    'size' => $item->size_range ?? 'N/A',
                    'type' => $item->harvest_type === 'total' ? 'Thu toàn bộ' : 'Thu tỉa',
                    'revenue' => number_format($item->total_amount) . 'đ'
                ],
                'Quản lý bán hàng' => [
                    'code' => $item->invoice_number,
                    'buyer' => $item->customer->name ?? 'N/A',
                    'date' => \Carbon\Carbon::parse($item->invoice_date)->format('d/m/Y'),
                    'total' => number_format($item->total_amount) . 'đ',
                    'paid' => number_format($item->paid_amount) . 'đ',
                    'rem' => number_format($item->total_amount - $item->paid_amount) . 'đ',
                    'status' => $item->status === 'paid' ? 'Đã thanh toán' : 'Nợ gối đầu',
                    'status_type' => $item->status === 'paid' ? 'success' : 'warning'
                ],
                'Quản lý khách hàng' => [
                    'name' => $item->name,
                    'phone' => $item->phone ?? '-',
                    'area' => $item->address ?? '-',
                    'bank' => $item->bank_account ?? '-',
                    'debt' => number_format($item->debt) . 'đ',
                    'status' => $item->debt > 0 ? 'Có dư nợ' : 'Đã thanh toán',
                    'status_type' => $item->debt > 0 ? 'warning' : 'success'
                ],
                'Chi phí vận hành' => [
                    'code' => 'CP-' . $item->id,
                    'date' => \Carbon\Carbon::parse($item->date)->format('d/m/Y'),
                    'category' => match ($item->expense_type) {
                            'electricity' => 'Điện & Năng lượng',
                            'feed' => 'Thức ăn',
                            'salary' => 'Lương nhân sự',
                            'fuel' => 'Nhiên liệu',
                            'maintenance' => 'Bảo trì ao',
                            default => 'Chi phí khác'
                        },
                    'desc' => $item->description ?? '-',
                    'amount' => number_format($item->amount) . 'đ',
                    'method' => $item->allocation_method === 'direct' ? 'Phân bổ trực tiếp' : 'Chia đều diện tích'
                ],
                default => []
            };
        }
        $config['rows'] = $realRows;
    }
    $canWrite = match ($title) {
        'Quản lý vụ nuôi' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('system_admin') || Auth::user()->hasRole('technician'),
        'Quản lý thả giống' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('technician'),
        'Nhật ký kỹ thuật ao' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('technician'),
        'Quản lý chỉ số nước' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('technician'),
        'Vật tư & Kho' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('warehouse_staff') || Auth::user()->hasRole('technician'),
        'Nhà cung cấp' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('warehouse_staff') || Auth::user()->hasRole('accountant'),
        'Quản lý thu hoạch' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('harvester') || Auth::user()->hasRole('technician'),
        'Quản lý bán hàng' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('accountant'),
        'Quản lý khách hàng' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('accountant'),
        'Chi phí vận hành' => Auth::user()->hasRole('owner') || Auth::user()->hasRole('accountant'),
        default => false
    };
@endphp

<x-app-layout>
    <div x-data="{ showAddModal: false, showDetailModal: false, detailData: null, activeTab: 'ao_nuoi' }"
        class="space-y-6">

        <!-- Header Page Section -->
        <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/85 shadow-sm">
            <div class="space-y-1">
                <div class="flex items-center space-x-2.5">
                    <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                        {!! $icon ?? '' !!}
                    </div>
                    <h2 class="font-bold text-xl text-slate-800 tracking-tight">
                        {{ $title }}
                    </h2>
                </div>
                <p class="text-xs text-slate-500 max-w-2xl mt-1 leading-relaxed">
                    {{ $description ?? '' }}
                </p>
            </div>
            @if($canWrite)
                <button @click="showAddModal = true"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center space-x-1.5 hover:shadow-lg hover:shadow-indigo-500/15">
                    <svg class="w-4 h-4 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                    <span>Thêm dữ liệu mới</span>
                </button>
            @else
                <div
                    class="px-4 py-2 bg-slate-50 border border-slate-200 text-slate-400 font-semibold text-xs rounded-xl flex items-center space-x-1.5">
                    <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z">
                        </path>
                    </svg>
                    <span>Chỉ xem (Read-Only)</span>
                </div>
            @endif
        </div>

        <!-- Stats Cards Row -->
        @if(!empty($config['stats']))
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($config['stats'] as $stat)
                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-1">
                        <span
                            class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">{{ $stat['label'] }}</span>
                        <div class="flex items-baseline space-x-1">
                            <span class="text-base font-extrabold text-slate-800 tracking-tight">{{ $stat['value'] }}</span>
                        </div>
                        <span class="text-[10px] text-slate-500 font-medium block mt-0.5">{{ $stat['desc'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Dynamic Custom Modules Widgets -->
        @if($title === 'Quản lý chỉ số nước')
            @include('placeholder-partials.top-sections.water-quality')
        @elseif($title === 'Chi phí vận hành')
            @include('placeholder-partials.top-sections.operating-expenses')
        @elseif($title === 'Vật tư & Kho')
            @include('placeholder-partials.top-sections.materials')
        @endif

        <!-- List Data Container -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <!-- Filter & Search Controls -->
            <div
                class="p-5 border-b border-slate-100 bg-slate-50/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="relative max-w-xs w-full">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" placeholder="Tìm kiếm nhanh..."
                        class="w-full bg-white border border-slate-200 pl-10 pr-4 py-2 text-xs focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all placeholder:text-slate-400">
                </div>
                <div class="flex items-center space-x-2 self-end sm:self-auto">
                    <select
                        class="bg-white border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-indigo-500 rounded-xl transition-all text-slate-600 font-medium">
                        <option>Tất cả trạng thái</option>
                        <option>Đang hoạt động</option>
                        <option>Đã hoàn thành</option>
                    </select>
                    <button
                        class="bg-slate-50 hover:bg-slate-100 border border-slate-200 px-3.5 py-2 text-xs font-semibold rounded-xl text-slate-700 transition-all flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3">
                            </path>
                        </svg>
                        <span>Xuất Excel</span>
                    </button>
                </div>
            </div>

            <!-- Table of Mock Data -->
            <div class="overflow-x-auto">
                @if($title === 'Quản lý chỉ số nước')
                    <!-- Tab 1: Chỉ số Ao Nuôi -->
                    <table x-show="activeTab === 'ao_nuoi'" class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr
                                class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px] whitespace-nowrap">
                                <th class="py-4 px-6">Thời Gian</th>
                                <th class="py-4 px-6">Ao Nuôi</th>
                                <th class="py-4 px-6">pH</th>
                                <th class="py-4 px-6">Oxy (DO)</th>
                                <th class="py-4 px-6">Độ Mặn</th>
                                <th class="py-4 px-6">Khí Độc NH₃</th>
                                <th class="py-4 px-6">Khí Độc H₂S</th>
                                <th class="py-4 px-6">Đánh Giá</th>
                                <th class="py-4 px-6 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                            @php
                                $aoNuoiLogs = $items->filter(function ($i) {
                                    return str_contains($i->sampling_location, 'Ao Rearing') || str_contains($i->sampling_location, 'Ao Gièo');
                                });
                            @endphp
                            @forelse($aoNuoiLogs as $log)
                                <tr class="hover:bg-slate-50/40 transition-colors whitespace-nowrap">
                                    <td class="py-4 px-6 font-semibold text-slate-800">
                                        {{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }} {{ $log->time }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-indigo-600">{{ $log->sampling_location }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->ph, 1) }}</td>
                                    <td class="py-4 px-6 text-slate-800">
                                        {{ $log->do !== null ? number_format($log->do, 1) . ' mg/L' : '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-slate-800">
                                        {{ $log->salinity !== null ? number_format($log->salinity, 1) . ' ppt' : '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-slate-800">
                                        {{ $log->nh3 !== null ? number_format($log->nh3, 2) . ' mg/L' : '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-slate-800">
                                        {{ $log->h2s !== null ? number_format($log->h2s, 3) . ' mg/L' : '-' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($log->ph < 7.0 || $log->ph > 8.5 || ($log->nh3 !== null && $log->nh3 > 0.1) || ($log->h2s !== null && $log->h2s > 0.01) || ($log->do !== null && $log->do < 4.0))
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-rose-700 bg-rose-50 border-rose-200">Cảnh
                                                báo</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-emerald-700 bg-emerald-50 border-emerald-200">An
                                                toàn</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết"
                                                class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                                    </path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-12 text-center text-slate-400">Không có dữ liệu ao nuôi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Tab 2: Chỉ số Ao Lắng -->
                    <table x-show="activeTab === 'ao_lang'" class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr
                                class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px] whitespace-nowrap">
                                <th class="py-4 px-6">Thời Gian</th>
                                <th class="py-4 px-6">Vị Trí Ao Lắng</th>
                                <th class="py-4 px-6">Độ Mặn</th>
                                <th class="py-4 px-6">pH</th>
                                <th class="py-4 px-6">Độ Trong</th>
                                <th class="py-4 px-6">Đánh Giá</th>
                                <th class="py-4 px-6 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                            @php
                                $aoLangLogs = $items->filter(function ($i) {
                                    return str_contains($i->sampling_location, 'Ao Lắng');
                                });
                            @endphp
                            @forelse($aoLangLogs as $log)
                                <tr class="hover:bg-slate-50/40 transition-colors whitespace-nowrap">
                                    <td class="py-4 px-6 font-semibold text-slate-800">
                                        {{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }} {{ $log->time }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-teal-600">{{ $log->sampling_location }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->salinity, 1) }} ppt</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->ph, 1) }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->transparency) }} cm</td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-emerald-700 bg-emerald-50 border-emerald-200">Đạt
                                            chuẩn</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết"
                                                class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                                    </path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400">Không có dữ liệu ao lắng.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Tab 3: Mực nước Cầu Cấp -->
                    <table x-show="activeTab === 'cau_cap'" class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr
                                class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px] whitespace-nowrap">
                                <th class="py-4 px-6">Thời Gian</th>
                                <th class="py-4 px-6">Vị Trí Cầu Cấp</th>
                                <th class="py-4 px-6">Mực Nước (m)</th>
                                <th class="py-4 px-6">Đỉnh Thủy Triều (m)</th>
                                <th class="py-4 px-6">Độ Mặn (ppt)</th>
                                <th class="py-4 px-6">Đánh Giá</th>
                                <th class="py-4 px-6 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                            @php
                                $cauCapLogs = $items->filter(function ($i) {
                                    return str_contains($i->sampling_location, 'Cầu Cấp');
                                });
                            @endphp
                            @forelse($cauCapLogs as $log)
                                <tr class="hover:bg-slate-50/40 transition-colors whitespace-nowrap">
                                    <td class="py-4 px-6 font-semibold text-slate-800">
                                        {{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }} {{ $log->time }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-sky-700">{{ $log->sampling_location }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->water_level, 2) }} m</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->tidal_peak, 2) }} m</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->salinity, 1) }} ppt</td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-indigo-700 bg-indigo-50 border-indigo-200">Đầy
                                            đủ</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết"
                                                class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                                    </path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400">Không có dữ liệu mực nước cầu cấp.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <!-- Other Modules Tables -->
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr
                                class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px] whitespace-nowrap">
                                @foreach($config['columns'] as $col)
                                    <th class="py-4 px-6">{{ $col }}</th>
                                @endforeach
                                <th class="py-4 px-6 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                            @forelse($config['rows'] as $row)
                                <tr class="hover:bg-slate-50/40 transition-colors whitespace-nowrap">
                                    @foreach($row as $key => $val)
                                        @if($key !== 'status_type' && $key !== '_id')
                                            <td class="py-4 px-6">
                                                @if($key === 'code')
                                                    <span class="font-mono font-bold text-slate-700">{{ $val }}</span>
                                                @elseif($key === 'status')
                                                    @php
                                                        $badgeType = $row['status_type'] ?? 'info';
                                                        $colorClasses = match ($badgeType) {
                                                            'success' => 'text-emerald-700 bg-emerald-50/65 border-emerald-200/60',
                                                            'warning' => 'text-amber-700 bg-amber-50/65 border-amber-200/60',
                                                            'danger' => 'text-rose-700 bg-rose-50/65 border-rose-200/60',
                                                            default => 'text-indigo-700 bg-indigo-50/65 border-indigo-200/60'
                                                        };
                                                    @endphp
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border {{ $colorClasses }}">
                                                        {{ $val }}
                                                    </span>
                                                @else
                                                    <span class="text-slate-800 font-semibold">{{ $val }}</span>
                                                @endif
                                            </td>
                                        @endif
                                    @endforeach
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết" @if(isset($row['_id'])) @click="
                                                fetch('/cultivation-cycles/{{ $row['_id'] }}')
                                                    .then(res => res.json())
                                                    .then(res => {
                                                        if(res.success) {
                                                            detailData = res.data; 
                                                            showDetailModal = true;
                                                        } else {
                                                            alert('Lỗi: ' + res.message);
                                                        }
                                                    })
                                            " @endif
                                                class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="py-12 text-center text-slate-400 font-medium">Không có dữ liệu mẫu
                                        được tìm thấy. Vui lòng bấm thêm mới ở trên.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Fake Pagination -->
            <div
                class="p-4 border-t border-slate-150 bg-slate-50/50 flex items-center justify-between text-slate-500 text-[11px] font-semibold">
                <span>Hiển thị {{ count($config['rows']) ?: '0' }} bản ghi từ cơ sở dữ liệu</span>
                <div class="inline-flex space-x-1">
                    <button
                        class="px-2.5 py-1 border border-slate-200 rounded-lg bg-white text-slate-400 cursor-not-allowed">Trước</button>
                    <button
                        class="px-2.5 py-1 border border-indigo-200 rounded-lg bg-indigo-50 text-indigo-700">1</button>
                    <button
                        class="px-2.5 py-1 border border-slate-200 rounded-lg bg-white text-slate-400 cursor-not-allowed">Sau</button>
                </div>
            </div>
        </div>

        <!-- Premium Add Data Form Modal Overlay -->
        <div x-show="showAddModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>

            <!-- Modal Body -->
            <div @click.away="showAddModal = false"
                class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 transform transition-all overflow-y-auto max-h-[85vh]"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-150 pb-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                            {!! $icon ?? '' !!}
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">
                                @if($title === 'Quản lý chỉ số nước')
                                    Ghi nhận chỉ số nước (<span
                                        x-text="activeTab === 'ao_nuoi' ? 'Ao Nuôi' : (activeTab === 'ao_lang' ? 'Ao Lắng' : 'Cầu Cấp')"></span>)
                                @else
                                    Thêm {{ $title }} Mới
                                @endif
                            </h3>
                            <p class="text-[10px] text-slate-400 mt-0.5">Nhập đầy đủ thông tin để ghi nhận vào cơ sở dữ
                                liệu</p>
                        </div>
                    </div>
                    <button @click="showAddModal = false"
                        class="text-slate-400 hover:text-slate-650 p-1.5 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modals Form Contents -->
                @if($title === 'Quản lý vụ nuôi')
                    @include('placeholder-partials.forms.cultivation-cycle')
                @elseif($title === 'Quản lý thả giống')
                    @include('placeholder-partials.forms.seed-batch')
                @elseif($title === 'Nhật ký kỹ thuật ao')
                    @include('placeholder-partials.forms.technical-log')
                @elseif($title === 'Quản lý chỉ số nước')
                    @include('placeholder-partials.forms.water-quality-log')
                @elseif($title === 'Vật tư & Kho')
                    @include('placeholder-partials.forms.material')
                @elseif($title === 'Nhà cung cấp')
                    @include('placeholder-partials.forms.supplier')
                @elseif($title === 'Quản lý thu hoạch')
                    @include('placeholder-partials.forms.harvest')
                @elseif($title === 'Quản lý bán hàng')
                    @include('placeholder-partials.forms.sales-invoice')
                @elseif($title === 'Quản lý khách hàng')
                    @include('placeholder-partials.forms.customer')
                @elseif($title === 'Chi phí vận hành')
                    @include('placeholder-partials.forms.operating-expense')
                @endif
            </div>
        </div>

        <!-- Modal Chi Tiết -->
        <div x-show="showDetailModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" x-cloak
            style="display: none;">
            <div @click.away="showDetailModal = false"
                class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-6 relative">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-5 pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2.5">
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Chi tiết Vụ Nuôi</h3>
                    </div>
                    <button @click="showDetailModal = false"
                        class="p-1 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <template x-if="detailData">
                    @if($title === 'Quản lý vụ nuôi')
                        @include('placeholder-partials.detail-modals.cultivation-cycle')
                    @endif
                </template>
            </div>
        </div>

    </div>

    @include('placeholder-partials.scripts')
</x-app-layout>