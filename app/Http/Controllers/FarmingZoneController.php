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
        // Mock data representing database structures for zones and nested ponds
        $farmingZones = [
            [
                'id' => 1,
                'code' => 'ZONE-A',
                'name' => 'Khu Nuôi Cánh Tây',
                'total_area' => 50000.00,
                'location' => 'Phía Tây đê bao sông Hậu',
                'status' => 'active',
                'rearing_ponds_count' => 3,
                'rehabilitating_ponds_count' => 1,
                'empty_ponds_count' => 1,
                'ponds' => [
                    [
                        'id' => 101,
                        'code' => 'A-01',
                        'name' => 'Ao Rearing 01',
                        'mouth_diameter' => 30.0,
                        'border_exclusion' => 2.0,
                        'bottom_diameter' => 26.0,
                        'area' => 530.93,
                        'pond_type' => 'rearing',
                        'status' => 'rearing' // 'rearing' (đang nuôi), 'rehabilitating' (cải tạo), 'empty' (trống)
                    ],
                    [
                        'id' => 102,
                        'code' => 'A-02',
                        'name' => 'Ao Rearing 02',
                        'mouth_diameter' => 30.0,
                        'border_exclusion' => 2.0,
                        'bottom_diameter' => 26.0,
                        'area' => 530.93,
                        'pond_type' => 'rearing',
                        'status' => 'rearing'
                    ],
                    [
                        'id' => 103,
                        'code' => 'A-03',
                        'name' => 'Ao Rearing 03',
                        'mouth_diameter' => 32.0,
                        'border_exclusion' => 2.5,
                        'bottom_diameter' => 27.0,
                        'area' => 572.56,
                        'pond_type' => 'rearing',
                        'status' => 'rearing'
                    ],
                    [
                        'id' => 104,
                        'code' => 'A-04',
                        'name' => 'Ao Gièo Ươm A',
                        'mouth_diameter' => 15.0,
                        'border_exclusion' => 1.5,
                        'bottom_diameter' => 12.0,
                        'area' => 113.10,
                        'pond_type' => 'nursery',
                        'status' => 'rehabilitating'
                    ],
                    [
                        'id' => 105,
                        'code' => 'A-05',
                        'name' => 'Ao Rearing 05',
                        'mouth_diameter' => 30.0,
                        'border_exclusion' => 2.0,
                        'bottom_diameter' => 26.0,
                        'area' => 530.93,
                        'pond_type' => 'rearing',
                        'status' => 'empty'
                    ]
                ]
            ],
            [
                'id' => 2,
                'code' => 'ZONE-B',
                'name' => 'Khu Nuôi Cánh Đông',
                'total_area' => 35000.00,
                'location' => 'Phía Đông cầu kênh 14',
                'status' => 'active',
                'rearing_ponds_count' => 2,
                'rehabilitating_ponds_count' => 2,
                'empty_ponds_count' => 0,
                'ponds' => [
                    [
                        'id' => 201,
                        'code' => 'B-01',
                        'name' => 'Ao Rearing B1',
                        'mouth_diameter' => 28.0,
                        'border_exclusion' => 2.0,
                        'bottom_diameter' => 24.0,
                        'area' => 452.39,
                        'pond_type' => 'rearing',
                        'status' => 'rearing'
                    ],
                    [
                        'id' => 202,
                        'code' => 'B-02',
                        'name' => 'Ao Rearing B2',
                        'mouth_diameter' => 28.0,
                        'border_exclusion' => 2.0,
                        'bottom_diameter' => 24.0,
                        'area' => 452.39,
                        'pond_type' => 'rearing',
                        'status' => 'rearing'
                    ],
                    [
                        'id' => 203,
                        'code' => 'B-03',
                        'name' => 'Ao Gièo B3',
                        'mouth_diameter' => 16.0,
                        'border_exclusion' => 1.5,
                        'bottom_diameter' => 13.0,
                        'area' => 132.73,
                        'pond_type' => 'nursery',
                        'status' => 'rehabilitating'
                    ],
                    [
                        'id' => 204,
                        'code' => 'B-04',
                        'name' => 'Ao Gièo B4',
                        'mouth_diameter' => 16.0,
                        'border_exclusion' => 1.5,
                        'bottom_diameter' => 13.0,
                        'area' => 132.73,
                        'pond_type' => 'nursery',
                        'status' => 'rehabilitating'
                    ]
                ]
            ]
        ];

        return view('farming-zones.index', compact('farmingZones'));
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
