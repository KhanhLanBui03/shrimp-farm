<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmingZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý khu nuôi',
            'description' => 'Tạo và cập nhật thông tin khu nuôi, xem danh sách khu nuôi và trạng thái tổng hợp (số ao đang nuôi/cải tạo/trống) và danh sách ao thuộc khu.',
            'features' => [
                'Tạo và cập nhật thông tin khu nuôi (tên, vị trí, diện tích tổng)',
                'Xem danh sách khu nuôi và trạng thái tổng hợp (số ao đang nuôi/cải tạo/trống)',
                'Xem danh sách ao thuộc khu'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>'
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
