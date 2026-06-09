<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeedBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý thả giống',
            'description' => 'Ghi nhận thông tin lô tôm giống mới, nguồn gốc, ngày thả, số lượng con, mật độ thả và theo dõi chi phí mua giống.',
            'features' => [
                'Nhập thông tin lô giống: tên giống, nguồn gốc, nhà cung cấp, đơn giá',
                'Ghi nhận ngày thả, số lượng giống, mật độ thả (con/m²)',
                'Hỗ trợ ao gièo: nhập số lượng giống gièo ban đầu, ghi nhận ngày chuyển sang ao nuôi',
                'Theo dõi chi phí mua giống và cập nhật ngân sách vụ'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>'
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
