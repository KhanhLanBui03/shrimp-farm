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
        $farmingZones = [
            ['id' => 1, 'code' => 'ZONE-A', 'name' => 'Khu Nuôi Cánh Tây'],
            ['id' => 2, 'code' => 'ZONE-B', 'name' => 'Khu Nuôi Cánh Đông']
        ];

        $ponds = [
            [
                'id' => 101,
                'code' => 'A-01',
                'name' => 'Ao Rearing 01',
                'farming_zone' => 'Khu Nuôi Cánh Tây',
                'farming_zone_id' => 1,
                'mouth_diameter' => 30.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 26.0,
                'area' => 530.93,
                'pond_type' => 'rearing',
                'status' => 'rearing',
                'history' => [
                    ['cycle' => 'VỤ NUÔI HÈ THU 2026', 'start_date' => '2026-03-01', 'harvest_date' => '2026-05-28', 'yield' => '4.2 tấn', 'status' => 'Đã thu hoạch'],
                    ['cycle' => 'VỤ NUÔI THU ĐÔNG 2025', 'start_date' => '2025-09-10', 'harvest_date' => '2025-12-15', 'yield' => '3.8 tấn', 'status' => 'Đã thu hoạch']
                ]
            ],
            [
                'id' => 102,
                'code' => 'A-02',
                'name' => 'Ao Rearing 02',
                'farming_zone' => 'Khu Nuôi Cánh Tây',
                'farming_zone_id' => 1,
                'mouth_diameter' => 30.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 26.0,
                'area' => 530.93,
                'pond_type' => 'rearing',
                'status' => 'rearing',
                'history' => [
                    ['cycle' => 'VỤ NUÔI HÈ THU 2026', 'start_date' => '2026-03-01', 'harvest_date' => '2026-05-28', 'yield' => '4.5 tấn', 'status' => 'Đã thu hoạch']
                ]
            ],
            [
                'id' => 103,
                'code' => 'A-03',
                'name' => 'Ao Rearing 03',
                'farming_zone' => 'Khu Nuôi Cánh Tây',
                'farming_zone_id' => 1,
                'mouth_diameter' => 32.0,
                'border_exclusion' => 2.5,
                'bottom_diameter' => 27.0,
                'area' => 572.56,
                'pond_type' => 'rearing',
                'status' => 'rearing',
                'history' => []
            ],
            [
                'id' => 104,
                'code' => 'A-04',
                'name' => 'Ao Gièo Ươm A',
                'farming_zone' => 'Khu Nuôi Cánh Tây',
                'farming_zone_id' => 1,
                'mouth_diameter' => 15.0,
                'border_exclusion' => 1.5,
                'bottom_diameter' => 12.0,
                'area' => 113.10,
                'pond_type' => 'nursery',
                'status' => 'rehabilitating',
                'history' => [
                    ['cycle' => 'ƯƠM GIỐNG KHÓA 1', 'start_date' => '2026-01-10', 'harvest_date' => '2026-02-15', 'yield' => 'Chuyển ao rearing', 'status' => 'Đã chuyển']
                ]
            ],
            [
                'id' => 105,
                'code' => 'A-05',
                'name' => 'Ao Rearing 05',
                'farming_zone' => 'Khu Nuôi Cánh Tây',
                'farming_zone_id' => 1,
                'mouth_diameter' => 30.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 26.0,
                'area' => 530.93,
                'pond_type' => 'rearing',
                'status' => 'empty',
                'history' => []
            ],
            [
                'id' => 201,
                'code' => 'B-01',
                'name' => 'Ao Rearing B1',
                'farming_zone' => 'Khu Nuôi Cánh Đông',
                'farming_zone_id' => 2,
                'mouth_diameter' => 28.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 24.0,
                'area' => 452.39,
                'pond_type' => 'rearing',
                'status' => 'rearing',
                'history' => []
            ],
            [
                'id' => 202,
                'code' => 'B-02',
                'name' => 'Ao Rearing B2',
                'farming_zone' => 'Khu Nuôi Cánh Đông',
                'farming_zone_id' => 2,
                'mouth_diameter' => 28.0,
                'border_exclusion' => 2.0,
                'bottom_diameter' => 24.0,
                'area' => 452.39,
                'pond_type' => 'rearing',
                'status' => 'rearing',
                'history' => []
            ],
            [
                'id' => 203,
                'code' => 'B-03',
                'name' => 'Ao Gièo B3',
                'farming_zone' => 'Khu Nuôi Cánh Đông',
                'farming_zone_id' => 2,
                'mouth_diameter' => 16.0,
                'border_exclusion' => 1.5,
                'bottom_diameter' => 13.0,
                'area' => 132.73,
                'pond_type' => 'nursery',
                'status' => 'rehabilitating',
                'history' => []
            ],
            [
                'id' => 204,
                'code' => 'B-04',
                'name' => 'Ao Gièo B4',
                'farming_zone' => 'Khu Nuôi Cánh Đông',
                'farming_zone_id' => 2,
                'mouth_diameter' => 16.0,
                'border_exclusion' => 1.5,
                'bottom_diameter' => 13.0,
                'area' => 132.73,
                'pond_type' => 'nursery',
                'status' => 'rehabilitating',
                'history' => []
            ]
        ];

        return view('ponds.index', compact('ponds', 'farmingZones'));
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
