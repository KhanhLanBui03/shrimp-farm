<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Harvest::with(['cultivationCycle', 'pond'])->latest()->get();

        return view('placeholder', [
            'title' => 'Quản lý thu hoạch',
            'description' => 'Ghi nhận và quản lý dữ liệu thu hoạch tôm thực tế (thu tỉa và thu hết). Thống kê sản lượng theo size, loại tôm (tôm sống, tôm chết 12 lấy 10, tôm ke), tính phí thuê tay lưới và tổng hợp doanh thu thu hoạch.',
            'features' => [
                'Thu tỉa: ghi nhận sản lượng, size (con/kg), loại tôm, ngày thu, tuổi tôm, vụ nuôi',
                'Thu hết: tổng hợp tôm còn lại trong ao và tự động chuyển trạng thái ao về Trống/Cải tạo',
                'Quản lý 3 phân loại tôm: Tôm sống | Tôm chết | Tôm ke',
                'Tính toán phí thuê tay lưới theo đợt thu hoạch',
                'Quản lý giá bán theo size và hỗ trợ trường hợp bán lẻ',
                'Tổng hợp kết quả thu hoạch toàn vụ (tổng khối lượng, doanh thu, cơ cấu size)'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cultivation_cycle_id' => 'required|exists:cultivation_cycles,id',
            'pond_id' => 'required|exists:ponds,id',
            'harvest_date' => 'required|date',
            'doc' => 'required|integer|min:0',
            'harvest_type' => 'required|string|in:total,partial',
            'shrimp_condition' => 'required|string|in:alive,dead',
            'weight' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'size_range' => 'required|string|max:100',
            'unit_price' => 'required|numeric|min:0',
            'net_rental_fee' => 'nullable|numeric|min:0',
        ]);

        $validated['total_amount'] = $validated['weight'] * $validated['unit_price'];
        $validated['net_rental_fee'] = $validated['net_rental_fee'] ?? 0;
        $validated['net_amount'] = $validated['total_amount'] - $validated['net_rental_fee'];

        $harvest = Harvest::create($validated);

        // Cập nhật trạng thái ao nếu là thu hoạch toàn bộ
        if ($validated['harvest_type'] === 'total') {
            $harvest->pond->update(['status' => 'empty']);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Ghi nhận thu hoạch',
            'description' => "Đã ghi nhận đợt thu hoạch: {$harvest->harvest_type} tại ao {$harvest->pond->name} (Sản lượng: " . number_format($harvest->weight) . " kg, Doanh thu: " . number_format($harvest->total_amount) . "đ)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Ghi nhận thu hoạch thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
