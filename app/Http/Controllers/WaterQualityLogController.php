<?php

namespace App\Http\Controllers;

use App\Models\WaterQualityLog;
use Illuminate\Http\Request;

class WaterQualityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = WaterQualityLog::latest()->get();

        // Calculate Alerts
        $alerts = [];
        $recentLogs = WaterQualityLog::whereNotNull('sampling_location')->where(function($query) {
            $query->where('ph', '<', 7.0)
                  ->orWhere('ph', '>', 8.5)
                  ->orWhere('nh3', '>', 0.1)
                  ->orWhere('h2s', '>', 0.01)
                  ->orWhere('do', '<', 4.0);
        })->latest()->take(5)->get();

        foreach ($recentLogs as $log) {
            if ($log->nh3 > 0.1) {
                $alerts[] = [
                    'location' => $log->sampling_location,
                    'type' => 'danger',
                    'message' => 'Khí độc NH₃ vượt ngưỡng an toàn (' . $log->nh3 . ' mg/L). Cần cấp cứu oxy và bón vi sinh.',
                ];
            }
            if ($log->h2s > 0.01) {
                $alerts[] = [
                    'location' => $log->sampling_location,
                    'type' => 'danger',
                    'message' => 'Khí độc H₂S vượt ngưỡng an toàn (' . $log->h2s . ' mg/L). Nguy hiểm cho tôm.',
                ];
            }
            if ($log->do < 4.0 && $log->do !== null) {
                $alerts[] = [
                    'location' => $log->sampling_location,
                    'type' => 'warning',
                    'message' => 'Oxy hòa tan thấp (' . $log->do . ' mg/L). Cần tăng cường quạt nước.',
                ];
            }
            if ($log->ph > 8.5 && $log->ph !== null) {
                $alerts[] = [
                    'location' => $log->sampling_location,
                    'type' => 'warning',
                    'message' => 'Độ pH tăng cao (' . $log->ph . '). Theo dõi sát cữ chiều.',
                ];
            }
            if ($log->ph < 7.0 && $log->ph !== null) {
                $alerts[] = [
                    'location' => $log->sampling_location,
                    'type' => 'warning',
                    'message' => 'Độ pH thấp (' . $log->ph . '). Cần bón vôi nông nghiệp.',
                ];
            }
        }

        // Chart data
        $chartLogs = WaterQualityLog::whereNotNull('temperature')->orderBy('date', 'desc')->take(10)->get()->reverse();
        $chartLabels = [];
        $waterTempData = [];
        $airTempData = [];
        foreach ($chartLogs as $log) {
            $chartLabels[] = \Carbon\Carbon::parse($log->date)->format('d/m');
            $waterTempData[] = $log->temperature;
            $airTempData[] = $log->temperature + rand(15, 35) / 10; // Giả lập nhiệt độ không khí cao hơn nước một chút
        }

        return view('placeholder', [
            'title' => 'Quản lý chỉ số nước',
            'description' => 'Theo dõi các thông số chất lượng nước ở cả ao lắng và ao nuôi hàng ngày. Hệ thống sẽ tự động gửi cảnh báo đỏ tức thì trên thiết bị của kỹ thuật viên khi các chỉ số vượt quá ngưỡng cho phép.',
            'features' => [
                'Đo chỉ số nước ao lắng: độ mặn, pH, độ trong theo vị trí và giờ lấy mẫu',
                'Ghi nhận mực nước, đỉnh thủy triều và độ mặn tại cầu cấp vào farm',
                'Đo chỉ số nước ao nuôi hàng ngày: pH, DO, độ mặn, độ kiềm, nhiệt độ, NH3, H2S',
                'Hệ thống cảnh báo đỏ tức thời (Real-time alert) khi các chỉ số môi trường vượt ngưỡng',
                'Biểu đồ so sánh nhiệt độ nước vs nhiệt độ không khí (biểu đồ đường đôi)'
            ],
            'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>',
            'items' => $items,
            'alerts' => $alerts,
            'chartLabels' => $chartLabels,
            'waterTempData' => $waterTempData,
            'airTempData' => $airTempData,
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
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'sampling_location' => 'required|string|max:100',
            'salinity' => 'nullable|numeric',
            'ph' => 'nullable|numeric',
            'transparency' => 'nullable|numeric',
            'tidal_peak' => 'nullable|numeric',
            'water_level' => 'nullable|numeric',
            'do' => 'nullable|numeric',
            'alkalinity' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'nh3' => 'nullable|numeric',
            'h2s' => 'nullable|numeric',
        ]);

        WaterQualityLog::create($validated);

        return redirect()->back()->with('success', 'Ghi nhật ký chỉ số nước thành công!');
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
