<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterQualityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý chỉ số nước',
            'description' => 'Theo dõi các thông số chất lượng nước ở cả ao lắng và ao nuôi hàng ngày. Hệ thống sẽ tự động gửi cảnh báo đỏ tức thì trên thiết bị của kỹ thuật viên khi các chỉ số vượt quá ngưỡng cho phép.',
            'features' => [
                'Đo chỉ số nước ao lắng: độ mặn, pH, độ trong theo vị trí và giờ lấy mẫu',
                'Ghi nhận mực nước, đỉnh thủy triều và độ mặn tại cầu cấp vào farm',
                'Đo chỉ số nước ao nuôi hàng ngày: pH, DO, độ mặn, độ kiềm, nhiệt độ, NH3, H2S',
                'Hệ thống cảnh báo đỏ tức thời (Real-time alert) khi các chỉ số môi trường vượt ngưỡng',
                'Biểu đồ so sánh nhiệt độ nước vs nhiệt độ không khí (biểu đồ đường đôi)'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>'
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
