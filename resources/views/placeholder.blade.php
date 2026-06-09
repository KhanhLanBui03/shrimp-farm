@php
    // Determine configuration based on title
    $config = match($title) {
        'Quản lý vụ nuôi' => [
            'stats' => [
                ['label' => 'Vụ đang hoạt động', 'value' => '2 Vụ nuôi', 'desc' => 'Tăng trưởng tốt'],
                ['label' => 'Diện tích mặt nước', 'value' => '12.500 m²', 'desc' => 'Tỉ lệ lấp đầy 85%'],
                ['label' => 'Tổng số ao tham gia', 'value' => '8 Ao nuôi', 'desc' => 'Gồm 2 ao gièo'],
                ['label' => 'Sản lượng dự kiến', 'value' => '35,7 Tấn', 'desc' => 'Dự kiến thu hoạch T8']
            ],
            'columns' => ['Mã Vụ', 'Tên Vụ Nuôi', 'Số Ao Thao Tác', 'Ngày Bắt Đầu', 'Dự Kiến Thu Hoạch', 'Trạng Thái'],
            'rows' => [
                ['code' => 'VU-2026-A', 'name' => 'Vụ Nuôi Hè Thu 2026', 'ponds' => '4 Ao nuôi', 'start' => '15/05/2026', 'end' => '15/08/2026', 'status' => 'Đang nuôi', 'status_type' => 'success'],
                ['code' => 'VU-2026-B', 'name' => 'Vụ Thả Thử Nghiệm CNC', 'ponds' => '2 Ao nuôi', 'start' => '01/06/2026', 'end' => '01/09/2026', 'status' => 'Đang nuôi', 'status_type' => 'success'],
                ['code' => 'VU-2025-C', 'name' => 'Vụ Đông Xuân 2025', 'ponds' => '6 Ao nuôi', 'start' => '10/11/2025', 'end' => '10/02/2026', 'status' => 'Đã thu hoạch', 'status_type' => 'info']
            ]
        ],
        'Quản lý thả giống' => [
            'stats' => [
                ['label' => 'Tổng lượng giống thả', 'value' => '1,2 Triệu con', 'desc' => 'Thả mật độ cao'],
                ['label' => 'Mật độ trung bình', 'value' => '120 con/m²', 'desc' => 'Đạt chuẩn CNC'],
                ['label' => 'Nhà cung cấp giống', 'value' => '3 Đối tác', 'desc' => 'Đã qua kiểm dịch'],
                ['label' => 'Tỉ lệ sống ban đầu', 'value' => '98%', 'desc' => 'Đo sau 15 ngày thả']
            ],
            'columns' => ['Mã Lô Giống', 'Nhà Cung Cấp', 'Số Lượng Thả', 'Mật Độ', 'Ao Chỉ Định', 'Ngày Thả', 'Tình Trạng'],
            'rows' => [
                ['code' => 'LG-CP-009', 'supplier' => 'C.P Group Việt Nam', 'qty' => '300.000 con', 'density' => '150 con/m²', 'pond' => 'Ao Rearing 01', 'date' => '20/05/2026', 'status' => 'Khỏe mạnh', 'status_type' => 'success'],
                ['code' => 'LG-VU-012', 'supplier' => 'Thủy sản Việt Úc', 'qty' => '400.000 con', 'density' => '120 con/m²', 'pond' => 'Ao Rearing 03', 'date' => '02/06/2026', 'status' => 'Khỏe mạnh', 'status_type' => 'success'],
                ['code' => 'LG-CP-008', 'supplier' => 'C.P Group Việt Nam', 'qty' => '250.000 con', 'density' => '130 con/m²', 'pond' => 'Ao Rearing 02', 'date' => '18/04/2026', 'status' => 'Đã thu hoạch', 'status_type' => 'info']
            ]
        ],
        'Nhật ký kỹ thuật ao' => [
            'stats' => [
                ['label' => 'Nhật ký hôm nay', 'value' => '8 Ghi nhận', 'desc' => 'Cập nhật bởi KTV'],
                ['label' => 'Lượng ăn hôm nay', 'value' => '320 kg', 'desc' => 'Thức ăn dạng hạt chìm'],
                ['label' => 'Trọng lượng TB tôm', 'value' => '12,5 g', 'desc' => 'Tăng trưởng +1.2g/tuần'],
                ['label' => 'Số lần Xiphong', 'value' => '3 Lần/ngày', 'desc' => 'Vệ sinh đáy ao tốt']
            ],
            'columns' => ['Thời Gian', 'Ao Nuôi', 'Lượng Thức Ăn', 'Trọng Lượng TB', 'Tỉ Lệ Sống Ước Tính', 'Kỹ Thuật Viên', 'Thao Tác Kỹ Thuật'],
            'rows' => [
                ['time' => 'Hôm nay 08:30', 'pond' => 'Ao Rearing 01', 'feed' => '45 kg', 'weight' => '14.2 g', 'survival' => '88%', 'ktv' => 'Nguyễn Văn Hùng', 'note' => 'Xiphong đáy ao, thay nước 10%'],
                ['time' => 'Hôm nay 07:15', 'pond' => 'Ao Rearing 02', 'feed' => '35 kg', 'weight' => '11.8 g', 'survival' => '92%', 'ktv' => 'Trần Quốc Bảo', 'note' => 'Bổ sung khoáng vi lượng, vôi CaO'],
                ['time' => 'Hôm qua 16:00', 'pond' => 'Ao Rearing 03', 'feed' => '50 kg', 'weight' => '9.5 g', 'survival' => '95%', 'ktv' => 'Nguyễn Văn Hùng', 'note' => 'Cho ăn cữ cuối, tăng cường quạt oxy']
            ]
        ],
        'Quản lý chỉ số nước' => [
            'stats' => [
                ['label' => 'Lần cập nhật cuối', 'value' => '10 Phút trước', 'desc' => 'Đo tự động + thủ công'],
                ['label' => 'Ao đạt chuẩn', 'value' => '6/8 Ao nuôi', 'desc' => 'Nhiệt độ, pH ổn định'],
                ['label' => 'Cảnh báo chỉ số', 'value' => '2 Ao nuôi', 'desc' => 'Khí độc NH3 cao nhẹ'],
                ['label' => 'Oxy hòa tan TB', 'value' => '5.2 mg/L', 'desc' => 'Ngưỡng an toàn (>4.5)']
            ],
            'columns' => ['Thời Gian', 'Ao Nuôi', 'pH', 'Oxy (DO)', 'Độ Mặn', 'Khí Độc NH₃', 'Khí Độc H₂S', 'Đánh Giá'],
            'rows' => [
                ['time' => 'Hôm nay 09:00', 'pond' => 'Ao Rearing 01', 'ph' => '7.8', 'do' => '5.2 mg/L', 'salinity' => '15 ppt', 'nh3' => '0.01 mg/L', 'h2s' => '0.002 mg/L', 'status' => 'An toàn', 'status_type' => 'success'],
                ['time' => 'Hôm nay 08:45', 'pond' => 'Ao Rearing 02', 'ph' => '8.2', 'do' => '4.1 mg/L', 'salinity' => '14 ppt', 'nh3' => '0.25 mg/L', 'h2s' => '0.05 mg/L', 'status' => 'Cảnh báo', 'status_type' => 'warning'],
                ['time' => 'Hôm nay 08:30', 'pond' => 'Ao Rearing 03', 'ph' => '7.5', 'do' => '5.8 mg/L', 'salinity' => '16 ppt', 'nh3' => '0.02 mg/L', 'h2s' => '0.001 mg/L', 'status' => 'An toàn', 'status_type' => 'success']
            ]
        ],
        'Vật tư & Kho' => [
            'stats' => [
                ['label' => 'Tổng mặt hàng tồn', 'value' => '24 Sản phẩm', 'desc' => 'Thức ăn, hóa chất, thiết bị'],
                ['label' => 'Tổng giá trị tồn kho', 'value' => '185.000.000đ', 'desc' => 'Kiểm kê ngày 01/06'],
                ['label' => 'Cảnh báo sắp hết', 'value' => '3 Mặt hàng', 'desc' => 'Dưới định mức tối thiểu'],
                ['label' => 'Số lượt xuất kho', 'value' => '14 Lượt/tuần', 'desc' => 'Chủ yếu phục vụ cữ ăn']
            ],
            'columns' => ['Tên Vật Tư', 'Phân Loại', 'Số Lượng Tồn', 'Đơn Vị', 'Vị Trí Kho', 'Định Mức Tối Thiểu', 'Tình Trạng'],
            'rows' => [
                ['name' => 'Thức ăn GrowMax 02', 'type' => 'Thức ăn tôm', 'qty' => '1,200', 'unit' => 'Bao (25kg)', 'loc' => 'Kho Vật Tư A', 'min' => '200 Bao', 'status' => 'Còn hàng', 'status_type' => 'success'],
                ['name' => 'Khoáng bột AquaMineral', 'type' => 'Hóa chất / Khoáng', 'qty' => '12', 'unit' => 'Bao (10kg)', 'loc' => 'Kho Hóa Chất B', 'min' => '50 Bao', 'status' => 'Sắp hết', 'status_type' => 'warning'],
                ['name' => 'Men vi sinh BioPro', 'type' => 'Chế phẩm sinh học', 'qty' => '0', 'unit' => 'Hộp (1kg)', 'loc' => 'Kho Hóa Chất B', 'min' => '10 Hộp', 'status' => 'Hết hàng', 'status_type' => 'danger']
            ]
        ],
        'Nhà cung cấp' => [
            'stats' => [
                ['label' => 'Tổng nhà cung cấp', 'value' => '12 Đối tác', 'desc' => 'Trong nước & Nhập khẩu'],
                ['label' => 'Công nợ hiện tại', 'value' => '92.400.000đ', 'desc' => 'Kỳ hạn thanh toán T6'],
                ['label' => 'Tỉ lệ giao đúng hẹn', 'value' => '98%', 'desc' => 'Đánh giá chất lượng vận chuyển'],
                ['label' => 'Đã ký hợp đồng', 'value' => '5 Doanh nghiệp', 'desc' => 'Giá ưu đãi dài hạn']
            ],
            'columns' => ['Tên Nhà Cung Cấp', 'Danh Mục Cung Cấp', 'Số Điện Thoại', 'Địa Chỉ Liên Hệ', 'Công Nợ', 'Trạng Thái'],
            'rows' => [
                ['name' => 'Công ty TNHH C.P. Việt Nam', 'supply' => 'Tôm giống, Thức ăn chăn nuôi', 'phone' => '0291-3829-xxx', 'address' => 'KCN Trà Nóc, Cần Thơ', 'debt' => '45.000.000đ', 'status' => 'Đang hợp tác', 'status_type' => 'success'],
                ['name' => 'Tập đoàn Thủy sản Việt Úc', 'supply' => 'Tôm giống công nghệ cao', 'phone' => '1900 7878', 'address' => 'Phan Thiết, Bình Thuận', 'debt' => '0đ', 'status' => 'Đang hợp tác', 'status_type' => 'success'],
                ['name' => 'Đại lý Vật tư Thủy sản Aqua Bạc Liêu', 'supply' => 'Vôi, khoáng, chế phẩm vi sinh', 'phone' => '0918-234-xxx', 'address' => 'TP. Bạc Liêu, Bạc Liêu', 'debt' => '47.400.000đ', 'status' => 'Đang hợp tác', 'status_type' => 'success']
            ]
        ],
        'Quản lý thu hoạch' => [
            'stats' => [
                ['label' => 'Đã thu hoạch', 'value' => '12,8 Tấn', 'desc' => 'Vụ nuôi 2026'],
                ['label' => 'Kích cỡ trung bình', 'value' => '45 con/kg', 'desc' => 'Tôm thương phẩm loại 1'],
                ['label' => 'Doanh thu tạm tính', 'value' => '1,92 Tỷ VND', 'desc' => 'Dựa trên giá thương lái chốt'],
                ['label' => 'Tỉ lệ hao hụt', 'value' => '8%', 'desc' => 'Nằm trong ngưỡng cho phép (<15%)']
            ],
            'columns' => ['Mã Thu Hoạch', 'Ao Nuôi', 'Ngày Thu Hoạch', 'Sản Lượng', 'Kích Cỡ (Size)', 'Hình Thức Thu', 'Doanh Thu'],
            'rows' => [
                ['code' => 'TH-2026-001', 'pond' => 'Ao Rearing 05', 'date' => '10/05/2026', 'qty' => '4.2 Tấn', 'size' => '38 con/kg', 'type' => 'Thu toàn bộ', 'revenue' => '672.000.000đ'],
                ['code' => 'TH-2026-002', 'pond' => 'Ao Rearing 02', 'date' => '22/05/2026', 'qty' => '2.5 Tấn', 'size' => '55 con/kg', 'type' => 'Thu tỉa bớt', 'revenue' => '350.000.000đ'],
                ['code' => 'TH-2026-003', 'pond' => 'Ao Rearing 04', 'date' => '01/06/2026', 'qty' => '6.1 Tấn', 'size' => '42 con/kg', 'type' => 'Thu toàn bộ', 'revenue' => '898.000.000đ']
            ]
        ],
        'Quản lý bán hàng' => [
            'stats' => [
                ['label' => 'Doanh số tháng này', 'value' => '1.240.000.000đ', 'desc' => 'Tăng 15% so với cùng kỳ'],
                ['label' => 'Đã thu tiền mặt/CK', 'value' => '1.050.000.000đ', 'desc' => 'Tỉ lệ thu hồi nợ 84%'],
                ['label' => 'Công nợ chưa thu', 'value' => '190.000.000đ', 'desc' => 'Chủ yếu từ thương lái quen'],
                ['label' => 'Sản lượng đã bán', 'value' => '12.800 kg', 'desc' => 'Giá bán trung bình 150k/kg']
            ],
            'columns' => ['Mã Hóa Đơn', 'Tên Thương Lái / Đơn Vị', 'Ngày Giao Dịch', 'Sản Lượng', 'Đơn Giá TB', 'Tổng Tiền', 'Thanh Toán'],
            'rows' => [
                ['code' => 'HD-2026-041', 'buyer' => 'Thương lái Trần Văn Thành', 'date' => '10/05/2026', 'qty' => '4.200 kg', 'price' => '160.000đ/kg', 'total' => '672.000.000đ', 'status' => 'Đã thu tiền', 'status_type' => 'success'],
                ['code' => 'HD-2026-042', 'buyer' => 'Công ty XNK Thủy sản Minh Phú', 'date' => '22/05/2026', 'qty' => '2.500 kg', 'price' => '140.000đ/kg', 'total' => '350.000.000đ', 'status' => 'Đã thu tiền', 'status_type' => 'success'],
                ['code' => 'HD-2026-043', 'buyer' => 'Thương lái Nguyễn Thị Lan', 'date' => '01/06/2026', 'qty' => '6.100 kg', 'price' => '147.200đ/kg', 'total' => '898.000.000đ', 'status' => 'Nợ gối đầu', 'status_type' => 'warning']
            ]
        ],
        'Quản lý khách hàng' => [
            'stats' => [
                ['label' => 'Tổng số khách hàng', 'value' => '18 Khách hàng', 'desc' => 'Thương lái tự do & Doanh nghiệp'],
                ['label' => 'Sản lượng tiêu thụ', 'value' => '35 Tấn/năm', 'desc' => 'Thị trường nội địa & Xuất khẩu'],
                ['label' => 'Khách hàng VIP', 'value' => '6 Đối tác', 'desc' => 'Có thỏa thuận bao tiêu'],
                ['label' => 'Hài lòng dịch vụ', 'value' => '100%', 'desc' => 'Không có khiếu nại về size tôm']
            ],
            'columns' => ['Khách Hàng', 'Số Điện Thế', 'Đại Bàn Thu Mua', 'Tổng Sản Lượng Đã Mua', 'Doanh Số Tích Lũy', 'Phân Nhóm'],
            'rows' => [
                ['name' => 'Thương lái Trần Văn Thành', 'phone' => '0909-382-xxx', 'area' => 'Bạc Liêu, Sóc Trăng', 'qty' => '12.5 Tấn', 'revenue' => '1.850.000.000đ', 'status' => 'Đại lý VIP', 'status_type' => 'success'],
                ['name' => 'Công ty XNK Thủy sản Minh Phú', 'phone' => '0291-3822xxx', 'area' => 'Cà Mau, Hậu Giang', 'qty' => '15.0 Tấn', 'revenue' => '2.400.000.000đ', 'status' => 'Doanh nghiệp', 'status_type' => 'info'],
                ['name' => 'Thương lái Nguyễn Thị Lan', 'phone' => '0913-928-xxx', 'area' => 'Bến Tre, Trà Vinh', 'qty' => '7.5 Tấn', 'revenue' => '1.120.000.000đ', 'status' => 'Thân thiết', 'status_type' => 'warning']
            ]
        ],
        'Chi phí vận hành' => [
            'stats' => [
                ['label' => 'Chi phí tháng này', 'value' => '142.500.000đ', 'desc' => 'Đã duyệt toàn bộ'],
                ['label' => 'Danh mục chi lớn nhất', 'value' => 'Tiền điện (45%)', 'desc' => 'Chạy quạt oxy liên tục'],
                ['label' => 'Đã thực hiện chi', 'value' => '128.000.000đ', 'desc' => 'Qua hình thức CK doanh nghiệp'],
                ['label' => 'Chi phí phát sinh', 'value' => '14.500.000đ', 'desc' => 'Bảo trì sửa chữa cánh quạt']
            ],
            'columns' => ['Mã Phiếu', 'Ngày Chi', 'Danh Mục Chi', 'Chi Tiết Nghiệp Vụ', 'Số Tiền Chi', 'Trạng Thái'],
            'rows' => [
                ['code' => 'CP-0098', 'date' => '05/06/2026', 'category' => 'Điện & Năng lượng', 'desc' => 'Thanh toán tiền điện trạm hạ thế tháng 05', 'amount' => '54.200.000đ', 'status' => 'Đã chi', 'status_type' => 'success'],
                ['code' => 'CP-0099', 'date' => '06/06/2026', 'category' => 'Nhiên liệu', 'desc' => 'Mua 500 lít dầu Diesel chạy máy phát dự phòng', 'amount' => '10.800.000đ', 'status' => 'Đã chi', 'status_type' => 'success'],
                ['code' => 'CP-0100', 'date' => '08/06/2026', 'category' => 'Nhân sự', 'desc' => 'Thanh toán lương kỹ thuật và công nhân đợt 1', 'amount' => '65.000.000đ', 'status' => 'Đã chi', 'status_type' => 'success']
            ]
        ],
        default => [
            'stats' => [],
            'columns' => [],
            'rows' => []
        ]
    };

    // If items are loaded from database, override standard rows with real data
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
                    'ktv' => 'Nguyễn Văn Hùng',
                    'note' => $item->notes ?? 'Bình thường'
                ],
                'Quản lý chỉ số nước' => [
                    'time' => \Carbon\Carbon::parse($item->date)->format('d/m/Y') . ' ' . $item->time,
                    'pond' => $item->sampling_location,
                    'ph' => number_format($item->ph, 1),
                    'do' => number_format($item->transparency, 1) . ' mg/L',
                    'salinity' => number_format($item->salinity) . ' ppt',
                    'nh3' => number_format($item->tidal_peak, 2) . ' mg/L',
                    'h2s' => number_format($item->water_level, 3) . ' mg/L',
                    'status' => 'Đã đo',
                    'status_type' => 'success'
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
                    'loc' => 'Kho chính',
                    'min' => '50 đơn vị',
                    'status' => $item->stock_quantity > 0 ? 'Còn hàng' : 'Hết hàng',
                    'status_type' => $item->stock_quantity > 0 ? 'success' : 'danger'
                ],
                'Nhà cung cấp' => [
                    'name' => $item->name,
                    'supply' => $item->supply_type ?? 'Tổng hợp',
                    'phone' => $item->phone ?? '-',
                    'address' => $item->address ?? '-',
                    'debt' => number_format($item->debt) . 'đ',
                    'status' => 'Đang hoạt động',
                    'status_type' => 'success'
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
                    'qty' => number_format($item->harvest->weight ?? 0) . ' kg',
                    'price' => number_format($item->harvest->unit_price ?? 0) . 'đ/kg',
                    'total' => number_format($item->total_amount) . 'đ',
                    'status' => $item->status === 'paid' ? 'Đã thu tiền' : 'Nợ gối đầu',
                    'status_type' => $item->status === 'paid' ? 'success' : 'warning'
                ],
                'Quản lý khách hàng' => [
                    'name' => $item->name,
                    'phone' => $item->phone ?? '-',
                    'area' => $item->address ?? '-',
                    'qty' => 'Liên kết bán hàng',
                    'revenue' => number_format($item->debt) . 'đ',
                    'status' => $item->debt > 0 ? 'Có dư nợ' : 'Đã đối soát',
                    'status_type' => $item->debt > 0 ? 'warning' : 'success'
                ],
                'Chi phí vận hành' => [
                    'code' => 'CP-' . $item->id,
                    'date' => \Carbon\Carbon::parse($item->date)->format('d/m/Y'),
                    'category' => $item->expense_type,
                    'desc' => $item->description ?? '-',
                    'amount' => number_format($item->amount) . 'đ',
                    'status' => $item->status === 'paid' ? 'Đã chi' : 'Chờ duyệt',
                    'status_type' => $item->status === 'paid' ? 'success' : 'warning'
                ],
                default => []
            };
        }
        $config['rows'] = $realRows;
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ $title }}
            </h2>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center space-x-1.5">
                <svg class="w-4 h-4 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                <span>Thêm dữ liệu mới</span>
            </button>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Module Description & Warning Alert -->
        <div class="bg-slate-800 text-slate-100 rounded-2xl p-5 border border-slate-700 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="px-2.5 py-0.5 text-[9px] font-bold text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 rounded uppercase tracking-wider">Module Nghiệp Vụ</span>
                <p class="text-sm text-slate-350 leading-relaxed max-w-3xl pt-1">
                    {{ $description }}
                </p>
            </div>
            <div class="flex items-center space-x-2 shrink-0 bg-slate-900/50 border border-slate-700/60 px-4 py-2 rounded-xl text-xs text-slate-400">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                <span class="font-medium">Chế độ xem trước dữ liệu mẫu</span>
            </div>
        </div>

        <!-- Dynamic Stats Grid -->
        @if(!empty($config['stats']))
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($config['stats'] as $stat)
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-2.5 hover:shadow-md transition-shadow">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">{{ $stat['label'] }}</span>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-2xl font-black text-slate-900 leading-none">{{ $stat['value'] }}</span>
                        </div>
                        <span class="text-xs text-slate-500 block font-normal">{{ $stat['desc'] }}</span>
                    </div>
                @endforeach
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
                                        <button title="Sửa đổi" class="p-1.5 border border-slate-200 hover:bg-slate-50 rounded-lg text-slate-500 hover:text-slate-800 transition-all">
                                            <svg class="w-3.5 h-3.5 stroke-[1.75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.586 2.586L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="py-12 text-center text-slate-400">Không có dữ liệu mẫu được tìm thấy.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Fake Pagination -->
            <div class="p-4 border-t border-slate-150 bg-slate-50/50 flex items-center justify-between text-slate-500 text-[11px] font-semibold">
                <span>Hiển thị 1 đến {{ count($config['rows']) }} trong số {{ count($config['rows']) }} bản ghi mẫu</span>
                <div class="inline-flex space-x-1">
                    <button class="px-2.5 py-1 border border-slate-200 rounded-lg bg-white text-slate-400 cursor-not-allowed">Trước</button>
                    <button class="px-2.5 py-1 border border-indigo-200 rounded-lg bg-indigo-50 text-indigo-700">1</button>
                    <button class="px-2.5 py-1 border border-slate-200 rounded-lg bg-white text-slate-400 cursor-not-allowed">Sau</button>
                </div>
            </div>
        </div>

        <!-- Checklist of features being developed -->
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 space-y-4">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Các chức năng nghiệp vụ đang trong lộ trình phát triển</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($features as $feature)
                    <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-slate-200/60 shadow-sm">
                        <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold shrink-0 mt-0.5">
                            ✓
                        </div>
                        <span class="text-xs font-semibold text-slate-700">{{ $feature }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
