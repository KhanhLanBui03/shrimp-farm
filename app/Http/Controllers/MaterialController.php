<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý vật tư & kho',
            'description' => 'Quản lý danh mục vật tư bao gồm thức ăn, thuốc, vi sinh, khoáng, hóa chất, thiết bị dụng cụ. Theo dõi chi tiết các nghiệp vụ nhập kho, xuất kho (tự động xuất khi cho ăn hoặc điều trị), tính giá tồn kho theo phương pháp bình quân gia quyền.',
            'features' => [
                'Danh mục vật tư: phân loại theo nhóm, hãng sản xuất, quy cách đóng gói, đơn giá',
                'Nghiệp vụ nhập kho: số lượng, đơn giá (hỗ trợ giá bình quân gia quyền), NCC',
                'Nghiệp vụ xuất kho: tự động tạo phiếu xuất kho khi ghi nhận nhật ký cho ăn / điều trị kỹ thuật',
                'Phương pháp tính giá xuất kho: Bình quân gia quyền (Weighted Average)',
                'Cảnh báo tồn kho tối thiểu & Hỗ trợ xuất kho âm tạm thời khi mất kết nối mạng',
                'Phiếu kiểm kê kho định kỳ: tính chênh lệch thực tế và tự động điều chỉnh số liệu kho'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>'
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
