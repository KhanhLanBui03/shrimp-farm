<?php

namespace App\Http\Controllers;

use App\Models\TechnicalLog;
use Illuminate\Http\Request;

class TechnicalLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = TechnicalLog::with(['cultivationCycle', 'pond'])->latest()->get();

        return view('placeholder', [
            'title' => 'Nhật ký kỹ thuật ao',
            'description' => 'Module cốt lõi ghi nhận nhật ký nuôi hàng ngày theo từng ao. Tự động tính toán các chỉ số kỹ thuật quan trọng như DOC, ADG, FCR tích lũy và tỷ lệ sống dựa trên dữ liệu nhập.',
            'features' => [
                'Theo dõi Ngày/tháng, Tuổi tôm (DOC - tự tính từ ngày thả)',
                'Ghi nhận thông số môi trường: Nhiệt độ nước, pH',
                'Quản lý thức ăn (g/con/ngày) và số liệu Si phong (lượng tôm si phong, lượng thức ăn dư thừa)',
                'Chài mẫu tôm: nhập size (con/kg) → Tự động tính ADG, FCR tích lũy, hao hụt',
                'Ghi nhận chuyển ao / sang ao / chiết ao'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
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
            'date' => 'required|date',
            'doc' => 'required|integer|min:0',
            'feed_amount' => 'nullable|numeric|min:0',
            'shrimp_size' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        TechnicalLog::create($validated);

        return redirect()->back()->with('success', 'Ghi nhật ký kỹ thuật thành công!');
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
