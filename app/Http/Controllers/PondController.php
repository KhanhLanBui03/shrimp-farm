<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use App\Models\FarmingZone;
use Illuminate\Http\Request;

class PondController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmingZones = FarmingZone::all()->map(function ($zone) {
            return [
                'id' => $zone->id,
                'code' => $zone->code,
                'name' => $zone->name,
            ];
        });

        $ponds = Pond::with(['farmingZone', 'cultivationCycles'])->get()->map(function ($pond) {
            return [
                'id' => $pond->id,
                'code' => $pond->code,
                'name' => $pond->name,
                'farming_zone' => $pond->farmingZone->name ?? 'Không xác định',
                'farming_zone_id' => $pond->farming_zone_id,
                'mouth_diameter' => (float) $pond->mouth_diameter,
                'border_exclusion' => (float) $pond->border_exclusion,
                'bottom_diameter' => (float) $pond->bottom_diameter,
                'area' => (float) $pond->area,
                'pond_type' => $pond->pond_type,
                'status' => $pond->status,
                'history' => $pond->cultivationCycles->map(function ($cycle) {
                    return [
                        'cycle' => $cycle->name,
                        'start_date' => $cycle->start_date,
                        'harvest_date' => $cycle->expected_end_date ?? 'Chưa kết thúc',
                        'yield' => 'N/A', // Có thể bổ sung sản lượng thực tế từ bảng harvests sau
                        'status' => $cycle->status === 'active' ? 'Đang nuôi' : 'Đã kết thúc',
                    ];
                })->toArray()
            ];
        });

        return view('ponds.index', compact('ponds', 'farmingZones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farming_zone_id' => 'required|exists:farming_zones,id',
            'code' => 'required|string|max:50|unique:ponds,code',
            'name' => 'required|string|max:255',
            'mouth_diameter' => 'required|numeric|min:0',
            'border_exclusion' => 'required|numeric|min:0',
            'pond_type' => 'required|in:nursery,rearing',
            'status' => 'required|in:empty,rehabilitating,ready,rearing',
        ]);

        // Tính toán các thông số hình học phía backend để đảm bảo chính xác
        $mouth = (float) $validated['mouth_diameter'];
        $exclusion = (float) $validated['border_exclusion'];
        $bottom = max(0.0, $mouth - $exclusion);
        $area = M_PI * pow(($bottom / 2), 2);

        $validated['bottom_diameter'] = $bottom;
        $validated['area'] = $area;

        Pond::create($validated);

        return redirect()->route('ponds.index')->with('success', 'Thêm ao nuôi thành công!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pond = Pond::findOrFail($id);

        $validated = $request->validate([
            'farming_zone_id' => 'required|exists:farming_zones,id',
            'code' => 'required|string|max:50|unique:ponds,code,' . $pond->id,
            'name' => 'required|string|max:255',
            'mouth_diameter' => 'required|numeric|min:0',
            'border_exclusion' => 'required|numeric|min:0',
            'pond_type' => 'required|in:nursery,rearing',
            'status' => 'required|in:empty,rehabilitating,ready,rearing',
        ]);

        // Tính toán lại các thông số hình học
        $mouth = (float) $validated['mouth_diameter'];
        $exclusion = (float) $validated['border_exclusion'];
        $bottom = max(0.0, $mouth - $exclusion);
        $area = M_PI * pow(($bottom / 2), 2);

        $validated['bottom_diameter'] = $bottom;
        $validated['area'] = $area;

        $pond->update($validated);

        return redirect()->route('ponds.index')->with('success', 'Cập nhật thông tin ao nuôi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pond = Pond::findOrFail($id);
        $pond->delete();

        return redirect()->route('ponds.index')->with('success', 'Xóa ao nuôi thành công!');
    }
}
