<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatingExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý chi phí vận hành',
            'description' => 'Theo dõi các khoản chi phí vận hành của trang trại bao gồm lương nhân công, thuê ngoài, năng lượng, sinh hoạt, vật tư thiết bị và chi phí bảo trì sửa chữa. Hỗ trợ workflow tạo và phê duyệt chi phí.',
            'features' => [
                'Phân loại chi phí: nhân công, thuê ngoài, năng lượng & sinh hoạt, vật tư thiết bị, sửa chữa bảo trì',
                'Phân bổ chi phí: Đích danh (100% cho 1 ao cụ thể) hoặc Chia đều (theo diện tích ao / số ao)',
                'Workflow phê duyệt: Kỹ thuật viên/nhân viên đề xuất → Chủ trại duyệt'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
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
        //
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
