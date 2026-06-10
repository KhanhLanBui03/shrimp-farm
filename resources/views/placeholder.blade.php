@php
    // Fetch lookup data for select dropdowns in modals
    $allPonds = \App\Models\Pond::all();
    $allSuppliers = \App\Models\Supplier::all();
    $allCycles = \App\Models\CultivationCycle::orderBy('start_date', 'desc')->get();
    $allCustomers = \App\Models\Customer::all();
    $allHarvests = \App\Models\Harvest::with('pond')->latest()->get();
    $allZones = \App\Models\FarmingZone::all();

    // Determine configuration based on title
    $config = match($title) {
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
            $realRows[] = match($title) {
                'Quản lý vụ nuôi' => [
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
                    'status' => 'Đã thả',
                    'status_type' => 'success'
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
                    'type' => match($item->type) {
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
                    'supply' => match($item->supply_type) {
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
                    'category' => match($item->expense_type) {
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
    $canWrite = match($title) {
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
    <div x-data="{ showAddModal: false, activeTab: 'ao_nuoi' }" class="space-y-6">
        
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
                <button @click="showAddModal = true" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center space-x-1.5 hover:shadow-lg hover:shadow-indigo-500/15">
                    <svg class="w-4 h-4 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                    <span>Thêm dữ liệu mới</span>
                </button>
            @else
                <div class="px-4 py-2 bg-slate-50 border border-slate-200 text-slate-400 font-semibold text-xs rounded-xl flex items-center space-x-1.5">
                    <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>
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
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">{{ $stat['label'] }}</span>
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Real-time Alerts Widget -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Hệ thống cảnh báo đỏ tức thời</h3>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                    </div>
                    <div class="space-y-2.5">
                        <div class="p-3 bg-rose-50/60 border border-rose-100 rounded-xl text-rose-800 text-xs flex items-start space-x-2.5">
                            <span class="text-sm">⚠️</span>
                            <div>
                                <span class="font-bold">Ao Rearing 02</span>
                                <p class="text-[10px] text-rose-600 mt-0.5">Khí độc NH₃ vượt ngưỡng an toàn (0.25 mg/L). Cần cấp cứu oxy và bón vi sinh xử lý đáy ao.</p>
                            </div>
                        </div>
                        <div class="p-3 bg-amber-50/60 border border-amber-100 rounded-xl text-amber-800 text-xs flex items-start space-x-2.5">
                            <span class="text-sm">⚠️</span>
                            <div>
                                <span class="font-bold">Ao Rearing 02</span>
                                <p class="text-[10px] text-amber-600 mt-0.5">Độ pH tăng cao nhẹ (8.2). Theo dõi sát cữ chiều.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperature Comparison Chart -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Biểu đồ so sánh nhiệt độ nước vs nhiệt độ không khí</h3>
                        <span class="text-[10px] text-slate-400 font-semibold">Đơn vị đo: °C</span>
                    </div>
                    <div class="relative h-44">
                        <canvas id="waterAirTempChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tabs for Ao Nuoi vs Ao Lang vs Cau Cap -->
            <div class="flex space-x-2 bg-slate-100 p-1 rounded-xl w-fit">
                <button @click="activeTab = 'ao_nuoi'" 
                        :class="activeTab === 'ao_nuoi' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all">
                    Chỉ số Ao Nuôi
                </button>
                <button @click="activeTab = 'ao_lang'" 
                        :class="activeTab === 'ao_lang' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all">
                    Chỉ số Ao Lắng
                </button>
                <button @click="activeTab = 'cau_cap'" 
                        :class="activeTab === 'cau_cap' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold transition-all">
                    Mực nước Cầu Cấp
                </button>
            </div>
        @endif

        @if($title === 'Chi phí vận hành')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Allocation Rule Widget -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Quy tắc phân bổ chi phí</h3>
                    <div class="space-y-3 text-xs">
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-150">
                            <span class="font-bold text-slate-700 block">Phân bổ đích danh (Direct)</span>
                            <span class="text-[10px] text-slate-400 mt-0.5 block">100% chi phí được ghi nhận trực tiếp cho 1 ao nuôi hoặc khu nuôi cụ thể.</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-150">
                            <span class="font-bold text-slate-700 block">Phân bổ chia đều (Equal Split)</span>
                            <span class="text-[10px] text-slate-400 mt-0.5 block">Chi phí chung (điện, nước sinh hoạt) được hệ thống tự động chia đều theo diện tích hoặc số ao hoạt động.</span>
                        </div>
                    </div>
                </div>

                <!-- Expense Distribution Chart -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-3">
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Cơ cấu phân bố chi phí vận hành</h3>
                    <div class="relative h-44">
                        <canvas id="expenseDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @if($title === 'Vật tư & Kho')
            <!-- Material Warnings -->
            <div class="bg-amber-50 border border-amber-200/60 rounded-2xl p-4 flex items-start space-x-3 text-xs text-amber-800">
                <span class="text-base">⚠️</span>
                <div>
                    <span class="font-bold">Cảnh báo tồn kho dưới hạn mức tối thiểu</span>
                    <p class="text-[10px] text-amber-600 mt-0.5">Hiện tại có 2 vật tư đã xuống dưới định mức tối thiểu hoặc hết hàng (Men vi sinh BioPro, Khoáng bột AquaMineral). Vui lòng lập phiếu đề xuất nhập kho bổ sung.</p>
                </div>
            </div>
        @endif

        @if($title === 'Quản lý vụ nuôi')
            <!-- Cultivation cycle timeline -->
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Quy trình lộ trình vụ nuôi tiêu chuẩn</h3>
                <div class="relative flex items-center justify-between text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                    <div class="absolute left-0 right-0 h-0.5 bg-slate-100 top-1/2 -translate-y-1/2 -z-10"></div>
                    <div class="flex flex-col items-center space-y-1 bg-white px-2">
                        <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">1</span>
                        <span>Khởi tạo</span>
                    </div>
                    <div class="flex flex-col items-center space-y-1 bg-white px-2">
                        <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">2</span>
                        <span>Cải tạo ao</span>
                    </div>
                    <div class="flex flex-col items-center space-y-1 bg-white px-2">
                        <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">3</span>
                        <span>Thả giống</span>
                    </div>
                    <div class="flex flex-col items-center space-y-1 bg-white px-2 text-indigo-600">
                        <span class="w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center">4</span>
                        <span class="font-black">Đang nuôi</span>
                    </div>
                    <div class="flex flex-col items-center space-y-1 bg-white px-2">
                        <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center">5</span>
                        <span>Thu hoạch</span>
                    </div>
                    <div class="flex flex-col items-center space-y-1 bg-white px-2">
                        <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center">6</span>
                        <span>Kết thúc</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- List Data Container -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <!-- Filter & Search Controls -->
            <div class="p-5 border-b border-slate-100 bg-slate-50/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="relative max-w-xs w-full">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" placeholder="Tìm kiếm nhanh..." 
                           class="w-full bg-white border border-slate-200 pl-10 pr-4 py-2 text-xs focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all placeholder:text-slate-400">
                </div>
                <div class="flex items-center space-x-2 self-end sm:self-auto">
                    <select class="bg-white border border-slate-200 px-3 py-2 text-xs focus:outline-none focus:border-indigo-500 rounded-xl transition-all text-slate-600 font-medium">
                        <option>Tất cả trạng thái</option>
                        <option>Đang hoạt động</option>
                        <option>Đã hoàn thành</option>
                    </select>
                    <button class="bg-slate-50 hover:bg-slate-100 border border-slate-200 px-3.5 py-2 text-xs font-semibold rounded-xl text-slate-700 transition-all flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
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
                            <tr class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
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
                                $aoNuoiLogs = $items->filter(function($i) {
                                    return str_contains($i->sampling_location, 'Ao Rearing') || str_contains($i->sampling_location, 'Ao Gièo');
                                });
                            @endphp
                            @forelse($aoNuoiLogs as $log)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-800">{{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }} {{ $log->time }}</td>
                                    <td class="py-4 px-6 font-bold text-indigo-600">{{ $log->sampling_location }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->ph, 1) }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->transparency, 1) }} mg/L</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->salinity) }} ppt</td>
                                    <td class="py-4 px-6 text-slate-800">{{ $log->tidal_peak ? number_format($log->tidal_peak, 2) . ' mg/L' : '-' }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ $log->water_level ? number_format($log->water_level, 2) . ' mg/L' : '-' }}</td>
                                    <td class="py-4 px-6">
                                        @if($log->ph > 8.0 || ($log->tidal_peak && $log->tidal_peak > 0.2))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-rose-700 bg-rose-50 border-rose-200">Cảnh báo</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-emerald-700 bg-emerald-50 border-emerald-200">An toàn</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết" class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="9" class="py-12 text-center text-slate-400">Không có dữ liệu ao nuôi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Tab 2: Chỉ số Ao Lắng -->
                    <table x-show="activeTab === 'ao_lang'" class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
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
                                $aoLangLogs = $items->filter(function($i) {
                                    return str_contains($i->sampling_location, 'Ao Lắng');
                                });
                            @endphp
                            @forelse($aoLangLogs as $log)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-800">{{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }} {{ $log->time }}</td>
                                    <td class="py-4 px-6 font-bold text-teal-600">{{ $log->sampling_location }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->salinity, 1) }} ppt</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->ph, 1) }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->transparency) }} cm</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-emerald-700 bg-emerald-50 border-emerald-200">Đạt chuẩn</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết" class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="py-12 text-center text-slate-400">Không có dữ liệu ao lắng.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Tab 3: Mực nước Cầu Cấp -->
                    <table x-show="activeTab === 'cau_cap'" class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
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
                                $cauCapLogs = $items->filter(function($i) {
                                    return str_contains($i->sampling_location, 'Cầu Cấp');
                                });
                            @endphp
                            @forelse($cauCapLogs as $log)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-800">{{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }} {{ $log->time }}</td>
                                    <td class="py-4 px-6 font-bold text-sky-700">{{ $log->sampling_location }}</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->water_level, 2) }} m</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->tidal_peak, 2) }} m</td>
                                    <td class="py-4 px-6 text-slate-800">{{ number_format($log->salinity, 1) }} ppt</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border text-indigo-700 bg-indigo-50 border-indigo-200">Đầy đủ</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center space-x-1.5">
                                            <button title="Xem chi tiết" class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="py-12 text-center text-slate-400">Không có dữ liệu mực nước cầu cấp.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <!-- Other Modules Tables -->
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50/60 border-b border-slate-200/60 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                                @foreach($config['columns'] as $col)
                                    <th class="py-4 px-6">{{ $col }}</th>
                                @endforeach
                                <th class="py-4 px-6 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-650 font-medium">
                            @forelse($config['rows'] as $row)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    @foreach($row as $key => $val)
                                        @if($key !== 'status_type')
                                            <td class="py-4 px-6">
                                                @if($key === 'code')
                                                    <span class="font-mono font-bold text-slate-700">{{ $val }}</span>
                                                @elseif($key === 'status')
                                                    @php
                                                        $badgeType = $row['status_type'] ?? 'info';
                                                        $colorClasses = match($badgeType) {
                                                            'success' => 'text-emerald-700 bg-emerald-50/65 border-emerald-200/60',
                                                            'warning' => 'text-amber-700 bg-amber-50/65 border-amber-200/60',
                                                            'danger' => 'text-rose-700 bg-rose-50/65 border-rose-200/60',
                                                            default => 'text-indigo-700 bg-indigo-50/65 border-indigo-200/60'
                                                        };
                                                    @endphp
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border {{ $colorClasses }}">
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
                                            <button title="Xem chi tiết" class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                                <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="py-12 text-center text-slate-400 font-medium">Không có dữ liệu mẫu được tìm thấy. Vui lòng bấm thêm mới ở trên.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Fake Pagination -->
            <div class="p-4 border-t border-slate-150 bg-slate-50/50 flex items-center justify-between text-slate-500 text-[11px] font-semibold">
                <span>Hiển thị {{ count($config['rows']) ?: '0' }} bản ghi từ cơ sở dữ liệu</span>
                <div class="inline-flex space-x-1">
                    <button class="px-2.5 py-1 border border-slate-200 rounded-lg bg-white text-slate-400 cursor-not-allowed">Trước</button>
                    <button class="px-2.5 py-1 border border-indigo-200 rounded-lg bg-indigo-50 text-indigo-700">1</button>
                    <button class="px-2.5 py-1 border border-slate-200 rounded-lg bg-white text-slate-400 cursor-not-allowed">Sau</button>
                </div>
            </div>
        </div>

        <!-- Premium Add Data Form Modal Overlay -->
        <div x-show="showAddModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak>
            
            <!-- Modal Body -->
            <div @click.away="showAddModal = false" 
                 class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 transform transition-all overflow-y-auto max-h-[85vh]"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-150 pb-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                            {!! $icon ?? '' !!}
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">
                                @if($title === 'Quản lý chỉ số nước')
                                    Ghi nhận chỉ số nước (<span x-text="activeTab === 'ao_nuoi' ? 'Ao Nuôi' : (activeTab === 'ao_lang' ? 'Ao Lắng' : 'Cầu Cấp')"></span>)
                                @else
                                    Thêm {{ $title }} Mới
                                @endif
                            </h3>
                            <p class="text-[10px] text-slate-400 mt-0.5">Nhập đầy đủ thông tin để ghi nhận vào cơ sở dữ liệu</p>
                        </div>
                    </div>
                    <button @click="showAddModal = false" class="text-slate-400 hover:text-slate-650 p-1.5 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modals Form Contents -->
                @if($title === 'Quản lý vụ nuôi')
                    <form method="POST" action="{{ route('cultivation-cycles.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Mã vụ nuôi *</label>
                                <input type="text" name="code" placeholder="VU-2026-X" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block mb-1">Tên vụ nuôi *</label>
                                <input type="text" name="name" placeholder="Vụ Hè Thu 2026" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Ngày bắt đầu *</label>
                                <input type="date" name="start_date" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block mb-1">Ngày kết thúc dự kiến</label>
                                <input type="date" name="expected_end_date" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Trạng thái *</label>
                            <select name="status" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500">
                                <option value="planning">Lập kế hoạch</option>
                                <option value="active">Đang hoạt động</option>
                                <option value="completed">Đã hoàn thành</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Quản lý thả giống')
                    <form method="POST" action="{{ route('seed-batches.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Vụ nuôi liên kết *</label>
                                <select name="cultivation_cycle_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allCycles as $cycle)
                                        <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">Ao nuôi thả *</label>
                                <select name="pond_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allPonds as $pond)
                                        <option value="{{ $pond->id }}">{{ $pond->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Nhà cung cấp giống *</label>
                                <select name="supplier_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allSuppliers as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">Mã lô giống *</label>
                                <input type="text" name="lot_number" placeholder="LG-CP-009" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Số lượng thả *</label>
                                <input type="number" name="quantity" placeholder="300000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Mật độ thả *</label>
                                <input type="number" name="stocking_density" placeholder="150" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Loại tôm giống *</label>
                                <input type="text" name="seed_type" value="Tôm thẻ chân trắng" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Ngày thả giống *</label>
                            <input type="date" name="stocking_date" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Nhật ký kỹ thuật ao')
                    <form method="POST" action="{{ route('technical-logs.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Vụ nuôi *</label>
                                <select name="cultivation_cycle_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allCycles as $cycle)
                                        <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">Ao nuôi *</label>
                                <select name="pond_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allPonds as $pond)
                                        <option value="{{ $pond->id }}">{{ $pond->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Ngày ghi nhận *</label>
                                <input type="date" name="date" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Số lượng thức ăn (kg) *</label>
                                <input type="number" name="feed_amount" placeholder="45" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Trọng lượng TB tôm (g) *</label>
                                <input type="number" step="0.01" name="shrimp_size" placeholder="12.5" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Tỉ lệ sống ước tính (%) *</label>
                                <input type="number" name="estimated_survival" placeholder="90" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Ghi chú kỹ thuật</label>
                            <textarea name="notes" placeholder="Thay nước 10%, bổ sung khoáng bột..." class="w-full bg-white border border-slate-200 p-2.5 rounded-xl focus:outline-none focus:border-indigo-500"></textarea>
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Quản lý chỉ số nước')
                    <form method="POST" action="{{ route('water-quality-logs.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Ngày đo *</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Giờ đo *</label>
                                <input type="time" name="time" value="{{ date('H:i') }}" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>

                        <!-- Dropdowns for sampling location mapping automatically to selected activeTab -->
                        <div>
                            <label class="block mb-1">Vị trí lấy mẫu *</label>
                            
                            <!-- Dropdown for Ao Nuoi -->
                            <select x-show="activeTab === 'ao_nuoi'" name="sampling_location" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl" :disabled="activeTab !== 'ao_nuoi'">
                                @foreach($allPonds as $pond)
                                    <option value="{{ $pond->name }}">{{ $pond->name }}</option>
                                @endforeach
                            </select>

                            <!-- Dropdown for Ao Lang -->
                            <select x-show="activeTab === 'ao_lang'" name="sampling_location" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl" :disabled="activeTab !== 'ao_lang'">
                                <option value="Ao Lắng A">Ao Lắng A (Khu Tây)</option>
                                <option value="Ao Lắng B">Ao Lắng B (Khu Đông)</option>
                            </select>

                            <!-- Dropdown for Cau Cap -->
                            <select x-show="activeTab === 'cau_cap'" name="sampling_location" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl" :disabled="activeTab !== 'cau_cap'">
                                <option value="Cầu Cấp A">Cầu Cấp A (Sông Tiền)</option>
                                <option value="Cầu Cấp B">Cầu Cấp B (Kênh Chính)</option>
                            </select>
                        </div>

                        <!-- Fields for Ao Nuoi -->
                        <div x-show="activeTab === 'ao_nuoi'" class="space-y-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block mb-1">pH (đơn vị)</label>
                                    <input type="number" step="0.1" name="ph" placeholder="7.8" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">Oxy hòa tan DO (mg/L)</label>
                                    <input type="number" step="0.1" name="transparency" placeholder="5.2" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">Độ Mặn (ppt)</label>
                                    <input type="number" step="0.1" name="salinity" placeholder="15" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-1">Khí Độc NH₃ (mg/L)</label>
                                    <input type="number" step="0.01" name="tidal_peak" placeholder="0.01" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">Khí Độc H₂S (mg/L)</label>
                                    <input type="number" step="0.001" name="water_level" placeholder="0.002" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                            </div>
                        </div>

                        <!-- Fields for Ao Lang -->
                        <div x-show="activeTab === 'ao_lang'" class="space-y-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block mb-1">Độ Mặn (ppt)</label>
                                    <input type="number" step="0.1" name="salinity" placeholder="16.5" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">pH</label>
                                    <input type="number" step="0.1" name="ph" placeholder="7.9" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">Độ Trong (cm)</label>
                                    <input type="number" step="0.1" name="transparency" placeholder="45" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                            </div>
                        </div>

                        <!-- Fields for Cau Cap -->
                        <div x-show="activeTab === 'cau_cap'" class="space-y-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block mb-1">Mực Nước (m)</label>
                                    <input type="number" step="0.01" name="water_level" placeholder="1.85" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">Đỉnh Thủy Triều (m)</label>
                                    <input type="number" step="0.01" name="tidal_peak" placeholder="2.1" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                                <div>
                                    <label class="block mb-1">Độ Mặn (ppt)</label>
                                    <input type="number" step="0.1" name="salinity" placeholder="14.5" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Vật tư & Kho')
                    <form method="POST" action="{{ route('materials.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Tên vật tư *</label>
                                <input type="text" name="name" placeholder="Thức ăn GrowMax 02" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Nhà cung cấp *</label>
                                <select name="supplier_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allSuppliers as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Phân loại *</label>
                                <select name="type" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
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
                                <input type="text" name="brand" placeholder="GrowMax" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Kích cỡ hạt (mm)</label>
                                <input type="number" step="0.1" name="pellet_size" placeholder="1.2" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Quy cách/Đơn vị *</label>
                                <input type="text" name="unit" placeholder="Bao (25kg)" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Số lượng tồn *</label>
                                <input type="number" name="stock_quantity" placeholder="1200" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Đơn giá nhập *</label>
                                <input type="number" name="unit_price" placeholder="380000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Hạn sử dụng</label>
                            <input type="date" name="expiration_date" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Nhà cung cấp')
                    <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Tên nhà cung cấp *</label>
                                <input type="text" name="name" placeholder="Công ty TNHH C.P. Việt Nam" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Phân loại hàng hóa *</label>
                                <input type="text" name="supply_type" placeholder="seeds, feed" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Số điện thoại</label>
                                <input type="text" name="phone" placeholder="0291-3829-xxx" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Email</label>
                                <input type="email" name="email" placeholder="contact@cp.com.vn" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">STK Ngân hàng</label>
                                <input type="text" name="bank_account" placeholder="Techcombank - 1903..." class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Dư nợ ban đầu (đ)</label>
                                <input type="number" name="debt" value="0" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Địa chỉ liên hệ</label>
                            <input type="text" name="address" placeholder="KCN Trà Nóc, Cần Thơ" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Quản lý thu hoạch')
                    <form method="POST" action="{{ route('harvests.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Vụ nuôi *</label>
                                <select name="cultivation_cycle_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allCycles as $cycle)
                                        <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">Ao thu hoạch *</label>
                                <select name="pond_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allPonds as $pond)
                                        <option value="{{ $pond->id }}">{{ $pond->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Ngày thu hoạch *</label>
                                <input type="date" name="harvest_date" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Tuổi tôm DOC *</label>
                                <input type="number" name="doc" placeholder="90" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Hình thức thu *</label>
                                <select name="harvest_type" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    <option value="total">Thu toàn bộ</option>
                                    <option value="partial">Thu tỉa bớt</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Khối lượng (kg) *</label>
                                <input type="number" name="weight" placeholder="4200" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Số lượng (con) *</label>
                                <input type="number" name="quantity" placeholder="160000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Tình trạng tôm *</label>
                                <select name="shrimp_condition" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    <option value="alive">Tôm sống</option>
                                    <option value="dead">Tôm ngộp/chết</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Kích cỡ Size (con/kg)</label>
                                <input type="text" name="size_range" placeholder="38 con/kg" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Đơn giá bán *</label>
                                <input type="number" name="unit_price" placeholder="160000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Phí thuê tay lưới (nếu có)</label>
                                <input type="number" name="net_rental_fee" value="0" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Quản lý bán hàng')
                    <form method="POST" action="{{ route('sales-invoices.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Mã hóa đơn bán hàng *</label>
                                <input type="text" name="invoice_number" placeholder="HD-2026-041" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Thương lái / Khách hàng *</label>
                                <select name="customer_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allCustomers as $cust)
                                        <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Đợt thu hoạch liên kết *</label>
                                <select name="harvest_id" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    @foreach($allHarvests as $harv)
                                        <option value="{{ $harv->id }}">TH-{{ $harv->id }} (Ao {{ $harv->pond->name ?? 'N/A' }} - {{ number_format($harv->weight) }}kg)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">Ngày hóa đơn *</label>
                                <input type="date" name="invoice_date" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-1">Tổng tiền hóa đơn *</label>
                                <input type="number" name="total_amount" placeholder="672000000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Đã thanh toán trước *</label>
                                <input type="number" name="paid_amount" placeholder="672000000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Trạng thái thanh toán *</label>
                                <select name="status" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    <option value="paid">Đã thanh toán hoàn toàn</option>
                                    <option value="unpaid">Nợ gối đầu / Chưa thanh toán</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Quản lý khách hàng')
                    <form method="POST" action="{{ route('customers.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Tên khách hàng / Thương lái *</label>
                                <input type="text" name="name" placeholder="Thương lái Trần Văn Thành" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Số điện thoại *</label>
                                <input type="text" name="phone" placeholder="0909-382-xxx" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Email</label>
                                <input type="email" name="email" placeholder="thanhtran@gmail.com" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">STK Ngân hàng</label>
                                <input type="text" name="bank_account" placeholder="Vietcombank - 0071..." class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Địa bàn / Địa chỉ thu mua</label>
                                <input type="text" name="address" placeholder="Bạc Liêu, Sóc Trăng" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Dư nợ ban đầu (đ)</label>
                                <input type="number" name="debt" value="0" class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif

                @if($title === 'Chi phí vận hành')
                    <form method="POST" action="{{ route('operating-expenses.store') }}" class="space-y-4 text-xs font-semibold text-slate-700">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Ngày chi *</label>
                                <input type="date" name="date" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Danh mục chi phí *</label>
                                <select name="expense_type" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
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
                                <select name="cost_center_type" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    <option value="zone">Khu nuôi (Zone)</option>
                                    <option value="pond">Ao nuôi (Pond)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">ID Trung tâm chi phí *</label>
                                <input type="number" name="cost_center_id" placeholder="1" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Phương thức phân bổ *</label>
                                <select name="allocation_method" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                                    <option value="direct">Phân bổ trực tiếp</option>
                                    <option value="equal_split">Chia đều</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1">Số tiền chi (đ) *</label>
                                <input type="number" name="amount" placeholder="54200000" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block mb-1">Chi tiết nghiệp vụ *</label>
                                <input type="text" name="description" placeholder="Thanh toán tiền điện trạm hạ thế tháng 05" required class="w-full bg-white border border-slate-200 p-2.5 rounded-xl">
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2.5 pt-4">
                            <button @click="showAddModal = false" type="button" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 font-bold">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Lưu lại</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Script tag for Chart.js if loaded -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($title === 'Quản lý chỉ số nước')
                const tempCtx = document.getElementById('waterAirTempChart').getContext('2d');
                new Chart(tempCtx, {
                    type: 'line',
                    data: {
                        labels: ['01/06', '02/06', '03/06', '04/06', '05/06', '06/06', '07/06', '08/06', '09/06', '10/06'],
                        datasets: [
                            {
                                label: 'Nhiệt độ nước (°C)',
                                data: [27.5, 28.0, 27.2, 28.5, 29.0, 28.8, 27.9, 28.1, 28.6, 28.3],
                                borderColor: '#4f46e5',
                                backgroundColor: 'rgba(79, 70, 229, 0.08)',
                                fill: true,
                                tension: 0.3,
                                borderWidth: 2.5,
                                pointBackgroundColor: '#4f46e5',
                            },
                            {
                                label: 'Nhiệt độ không khí (°C)',
                                data: [31.2, 32.0, 30.5, 33.1, 34.0, 32.5, 31.8, 32.2, 33.5, 32.9],
                                borderColor: '#f59e0b',
                                backgroundColor: 'transparent',
                                tension: 0.3,
                                borderWidth: 2,
                                pointBackgroundColor: '#f59e0b',
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: { color: '#64748b', font: { size: 10, weight: '600' } }
                            }
                        },
                        scales: {
                            y: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { color: '#f1f5f9' } },
                            x: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { display: false } }
                        }
                    }
                });
            @endif

            @if($title === 'Chi phí vận hành')
                const costCtx = document.getElementById('expenseDistributionChart').getContext('2d');
                new Chart(costCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Điện & Năng lượng', 'Lương nhân sự', 'Nhiên liệu', 'Bảo trì ao', 'Khác'],
                        datasets: [{
                            label: 'Số tiền (VND)',
                            data: [54200000, 65000000, 10800000, 14500000, 8000000],
                            backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ec4899', '#94a3b8'],
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { color: '#f1f5f9' } },
                            x: { ticks: { color: '#94a3b8', font: { size: 9 } }, grid: { display: false } }
                        }
                    }
                });
            @endif
        });
    </script>
</x-app-layout>
