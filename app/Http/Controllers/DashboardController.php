<?php

namespace App\Http\Controllers;

use App\Models\FarmingZone;
use App\Models\Pond;
use App\Models\CultivationCycle;
use App\Models\OperatingExpense;
use App\Models\TechnicalLog;
use App\Models\WaterQualityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống kê tổng quan
        $totalZones = FarmingZone::count();
        $totalPonds = Pond::count();
        $activeCycles = CultivationCycle::where('status', 'active')->count();
        $totalExpenses = OperatingExpense::sum('amount');

        // 2. Thống kê chi phí hàng tháng (database-agnostic)
        $allExpenses = OperatingExpense::all();
        $expensesByMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthKey = str_pad($i, 2, '0', STR_PAD_LEFT);
            $expensesByMonth[$monthKey] = 0;
        }
        foreach ($allExpenses as $expense) {
            if ($expense->date) {
                $month = date('m', strtotime($expense->date));
                $expensesByMonth[$month] = ($expensesByMonth[$month] ?? 0) + (float) $expense->amount;
            }
        }
        $chartLabels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        $chartData = array_values($expensesByMonth);

        // 3. Nhật ký kỹ thuật gần nhất
        $recentLogs = TechnicalLog::with(['pond', 'cultivationCycle'])
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // 4. Lấy nhật ký chất lượng nước gần nhất để phân tích cảnh báo
        $latestWaterLogs = WaterQualityLog::orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->take(5)
            ->get();

        // 5. Thống kê số ao theo từng trạng thái để làm biểu đồ tròn
        $pondsStatus = [
            'rearing' => Pond::where('status', 'rearing')->count(),
            'rehabilitating' => Pond::where('status', 'rehabilitating')->count(),
            'ready' => Pond::where('status', 'ready')->count(),
            'empty' => Pond::where('status', 'empty')->count(),
        ];

        return view('dashboard', compact(
            'totalZones',
            'totalPonds',
            'activeCycles',
            'totalExpenses',
            'chartLabels',
            'chartData',
            'recentLogs',
            'latestWaterLogs',
            'pondsStatus'
        ));
    }
}
