<?php

namespace App\Http\Controllers;

use App\Models\OperatingExpense;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OperatingExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = OperatingExpense::latest()->get();

        return view('placeholder', [
            'title' => 'Chi phí vận hành',
            'description' => 'Theo dõi các khoản chi phí vận hành của trang trại bao gồm lương nhân công, thuê ngoài, năng lượng, sinh hoạt, vật tư thiết bị và chi phí bảo trì sửa chữa. Hỗ trợ workflow tạo và phê duyệt chi phí.',
            'features' => [
                'Phân loại chi phí: nhân công, thuê ngoài, năng lượng & sinh hoạt, vật tư thiết bị, sửa chữa bảo trì',
                'Phân bổ chi phí: Đích danh (100% cho 1 ao cụ thể) hoặc Chia đều (theo diện tích ao / số ao)',
                'Workflow phê duyệt: Kỹ thuật viên/nhân viên đề xuất → Chủ trại duyệt'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
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
            'date' => 'required|date',
            'expense_type' => 'required|string|in:electricity,feed,salary,fuel,maintenance,chemicals,probiotic,mineral,seed,other',
            'description' => 'nullable|string|max:500',
            'amount' => 'required|numeric|min:0',
            'cost_center_type' => 'required|string|in:zone,pond,App\Models\FarmingZone,App\Models\Pond',
            'cost_center_id' => 'required|integer',
            'allocation_method' => 'required|string|in:direct,equal_split',
        ]);

        if ($validated['cost_center_type'] === 'zone') {
            $validated['cost_center_type'] = 'App\Models\FarmingZone';
        } elseif ($validated['cost_center_type'] === 'pond') {
            $validated['cost_center_type'] = 'App\Models\Pond';
        }

        $expense = OperatingExpense::create($validated);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Ghi nhận chi phí vận hành',
            'description' => "Đã ghi nhận chi phí mới: " . number_format($expense->amount) . "đ cho mục {$expense->expense_type}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Ghi nhận chi phí vận hành thành công!');
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
