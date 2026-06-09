<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('placeholder', [
            'title' => 'Quản lý khách hàng',
            'description' => 'Xem danh sách và thông tin liên hệ các thương lái, khách hàng thu mua tôm thương phẩm. Theo dõi công nợ, thời hạn thanh toán và lịch sử giao dịch chi tiết.',
            'features' => [
                'Thông tin khách hàng: tên, SĐT, địa chỉ, lịch sử mua hàng',
                'Quản lý công nợ khách hàng: số dư nợ hiện tại, ngày đến hạn thanh toán',
                'Lịch sử thanh toán công nợ chi tiết',
                'Báo cáo doanh số bán hàng theo từng khách hàng thương lái'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>'
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
