<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PondController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý ao nuôi',
            'description' => 'Quản lý thông số ao nuôi, loại ao nuôi (thương phẩm/gièo), trạng thái ao nuôi và lịch sử sử dụng ao.',
            'features' => [
                'Tạo ao nuôi (tự động tính diện tích đáy từ đường kính miệng và bờ)',
                'Phân loại ao: Ao nuôi thương phẩm hoặc Ao Gièo (ao ươm)',
                'Quản lý trạng thái ao: Trống → Cải tạo → Sẵn sàng thả → Đang nuôi → Ngưng sử dụng',
                'Xem lịch sử sử dụng của từng ao'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>'
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
