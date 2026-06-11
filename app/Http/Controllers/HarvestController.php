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
        $allPonds = \App\Models\Pond::orderBy('name')->get();
        $allCycles = \App\Models\CultivationCycle::orderBy('start_date', 'desc')->get();

        return view('harvests.index', [
            'title' => 'Quản lý thu hoạch',
            'description' => 'Ghi nhận và quản lý dữ liệu thu hoạch tôm thực tế (thu tỉa và thu hết). Thống kê sản lượng theo size, loại tôm, tính phí thuê tay lưới và tổng hợp doanh thu thu hoạch.',
            'items' => $items,
            'allPonds' => $allPonds,
            'allCycles' => $allCycles,
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
            'shrimp_condition' => 'required|string|in:alive,substandard,dead',
            'weight' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'size_range' => 'nullable|string|max:100',
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

        return redirect()->route('harvests.index')->with('success', 'Ghi nhận thu hoạch thành công!');
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
        $harvest = Harvest::findOrFail($id);

        $validated = $request->validate([
            'cultivation_cycle_id' => 'required|exists:cultivation_cycles,id',
            'pond_id' => 'required|exists:ponds,id',
            'harvest_date' => 'required|date',
            'doc' => 'required|integer|min:0',
            'harvest_type' => 'required|string|in:total,partial',
            'shrimp_condition' => 'required|string|in:alive,substandard,dead',
            'weight' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'size_range' => 'nullable|string|max:100',
            'unit_price' => 'required|numeric|min:0',
            'net_rental_fee' => 'nullable|numeric|min:0',
        ]);

        $validated['total_amount'] = $validated['weight'] * $validated['unit_price'];
        $validated['net_rental_fee'] = $validated['net_rental_fee'] ?? 0;
        $validated['net_amount'] = $validated['total_amount'] - $validated['net_rental_fee'];

        $harvest->update($validated);

        // Cập nhật trạng thái ao nếu là thu hoạch toàn bộ
        if ($validated['harvest_type'] === 'total') {
            $harvest->pond->update(['status' => 'empty']);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Cập nhật thu hoạch',
            'description' => "Đã cập nhật đợt thu hoạch: {$harvest->harvest_type} tại ao {$harvest->pond->name} (Sản lượng: " . number_format($harvest->weight) . " kg)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('harvests.index')->with('success', 'Cập nhật thông tin thu hoạch thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $harvest = Harvest::findOrFail($id);
        $pondName = $harvest->pond->name ?? 'N/A';
        $weight = $harvest->weight;

        $harvest->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Xóa thu hoạch',
            'description' => "Đã xóa đợt thu hoạch tại ao {$pondName} (Sản lượng: " . number_format($weight) . " kg)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('harvests.index')->with('success', 'Xóa thông tin thu hoạch thành công!');
    }
}
