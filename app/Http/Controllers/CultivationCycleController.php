<?php

namespace App\Http\Controllers;

use App\Models\CultivationCycle;
use Illuminate\Http\Request;

class CultivationCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CultivationCycle::with('ponds')->latest()->get();

        return view('placeholder', [
            'title' => 'Quản lý vụ nuôi',
            'description' => 'Quản lý thông tin vụ nuôi, gán ao tham gia vụ, theo dõi tiến độ vụ nuôi và tổng hợp lượng thức ăn toàn vụ.',
            'features' => [
                'Tạo vụ nuôi mới và gắn các ao tham gia (một vụ nhiều ao, bao gồm cả ao gièo)',
                'Theo dõi trạng thái vụ nuôi: Khởi tạo → Cải tạo ao → Thả giống → Đang nuôi → Thu hoạch → Kết thúc',
                'Bảng tổng hợp thức ăn toàn vụ theo từng ao',
                'Quyết toán vụ nuôi: tổng chi phí đối chiếu tổng doanh thu → lợi nhuận vụ'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 6H16"></path></svg>',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:cultivation_cycles,code|max:50',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'expected_end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:planning,active,completed,cancelled',
            'pond_ids' => 'nullable|array',
            'pond_ids.*' => 'exists:ponds,id',
        ], [
            'start_date.after_or_equal' => 'Ngày bắt đầu vụ nuôi không được phép trước ngày hiện tại.',
            'expected_end_date.after_or_equal' => 'Ngày kết thúc dự kiến phải sau hoặc bằng ngày bắt đầu.',
        ]);

        $cycle = CultivationCycle::create($validated);

        if ($request->has('pond_ids')) {
            $cycle->ponds()->attach($request->input('pond_ids'));
        }

        return redirect()->back()->with('success', 'Thêm vụ nuôi thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cycle = CultivationCycle::with('ponds')->find($id);

        if (!$cycle) {
            return response()->json([
                'success' => false,
                'message' => 'Vụ nuôi không tồn tại'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cycle
        ]);
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
