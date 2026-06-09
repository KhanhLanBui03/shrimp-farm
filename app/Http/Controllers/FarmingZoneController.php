<?php

namespace App\Http\Controllers;

use App\Models\FarmingZone;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FarmingZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmingZones = FarmingZone::with('ponds')->get()->map(function ($zone) {
            // Tự động đếm các trạng thái của ao thuộc khu nuôi này
            return [
                'id' => $zone->id,
                'code' => $zone->code,
                'name' => $zone->name,
                'total_area' => $zone->total_area,
                'location' => $zone->location,
                'status' => $zone->status,
                'rearing_ponds_count' => $zone->ponds->where('status', 'rearing')->count(),
                'rehabilitating_ponds_count' => $zone->ponds->where('status', 'rehabilitating')->count(),
                'empty_ponds_count' => $zone->ponds->where('status', 'empty')->count(),
                'ponds' => $zone->ponds->map(function ($pond) {
                    return [
                        'id' => $pond->id,
                        'code' => $pond->code,
                        'name' => $pond->name,
                        'mouth_diameter' => $pond->mouth_diameter,
                        'border_exclusion' => $pond->border_exclusion,
                        'bottom_diameter' => $pond->bottom_diameter,
                        'area' => $pond->area,
                        'pond_type' => $pond->pond_type,
                        'status' => $pond->status,
                    ];
                })
            ];
        });
        return view('farming-zones.index', compact('farmingZones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(([
            'code' => 'required|string|unique:farming_zones,code|max:50',
            'name' => 'required|string|max:255',
            'total_area' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
        ]));
        $zone = FarmingZone::create($validated);

        // Ghi log hoạt động
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Thêm khu nuôi',
            'description' => "Đã tạo khu nuôi mới: {$zone->name} (Mã: {$zone->code})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('farming-zones.index')->with('success', 'Thêm khu nuôi thành công!');
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
        $zone = FarmingZone::findOrFail($id);
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:farming_zones,code,' . $zone->id,
            'name' => 'required|string|max:255',
            'total_area' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
        ]);
        $zone->update($validated);

        // Ghi log hoạt động
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Cập nhật khu nuôi',
            'description' => "Đã cập nhật thông tin khu nuôi: {$zone->name} (Mã: {$zone->code})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('farming-zones.index')->with('success', 'Cập nhật khu nuôi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $zone = FarmingZone::findOrFail($id);
        $name = $zone->name;
        $code = $zone->code;
        $zone->delete();

        // Ghi log hoạt động
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Xóa khu nuôi',
            'description' => "Đã xóa khu nuôi: {$name} (Mã: {$code})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('farming-zones.index')->with('success', 'Xóa khu nuôi thành công!');
    }
}
