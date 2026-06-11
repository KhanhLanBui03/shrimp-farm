<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use App\Models\FarmingZone;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
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

        $ponds = Pond::with(['farmingZone', 'cultivationCycles', 'harvests'])->get()->map(function ($pond) {
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
                'history' => $pond->cultivationCycles->map(function ($cycle) use ($pond) {
                    $totalYield = $pond->harvests
                        ->where('cultivation_cycle_id', $cycle->id)
                        ->sum('weight');

                    return [
                        'cycle' => $cycle->name,
                        'start_date' => $cycle->start_date,
                        'harvest_date' => $cycle->expected_end_date ?? 'Chưa kết thúc',
                        'yield' => $totalYield > 0 ? number_format($totalYield, 1) . ' kg' : 'Chưa có',
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

        $pond = Pond::create($validated);

        // Ghi log hoạt động
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Thêm ao nuôi',
            'description' => "Đã tạo ao nuôi mới: {$pond->name} (Mã ao: {$pond->code}, Diện tích đáy: " . number_format($pond->area, 2) . " m²)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

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

        // Ghi log hoạt động
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Cập nhật ao nuôi',
            'description' => "Đã cập nhật thông tin ao nuôi: {$pond->name} (Mã ao: {$pond->code})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('ponds.index')->with('success', 'Cập nhật thông tin ao nuôi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $pond = Pond::findOrFail($id);
        $name = $pond->name;
        $code = $pond->code;
        $pond->delete();

        // Ghi log hoạt động
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Xóa ao nuôi',
            'description' => "Đã xóa ao nuôi: {$name} (Mã ao: {$code})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('ponds.index')->with('success', 'Xóa ao nuôi thành công!');
    }
}
