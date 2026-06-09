<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Supplier::latest()->get();

        return view('placeholder', [
            'title' => 'Nhà cung cấp',
            'description' => 'Xem danh sách và thông tin các nhà cung cấp thức ăn, thuốc, vi sinh, vật tư và giống. Theo dõi lịch sử giao dịch mua hàng, biến động giá và công nợ với từng nhà cung cấp.',
            'features' => [
                'Thông tin NCC: tên, SĐT, email, địa chỉ, STK ngân hàng, loại hàng cung cấp',
                'Lịch sử giao dịch nhập hàng chi tiết theo từng NCC',
                'Theo dõi công nợ NCC (đã thanh toán / chưa / còn nợ)',
                'Theo dõi biến động giá nhập theo thời gian'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
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
