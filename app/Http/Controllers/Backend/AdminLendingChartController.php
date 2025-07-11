<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Returns;
use Carbon\Carbon;

class AdminLendingChartController extends Controller
{

    public function getAdminLendingChartData()
    {
        $labels = [];
        $pending = [];
        $success = [];

        // logika for ambil 12 bulan terakhir
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->startOfMonth();
            $label = $month->format('M Y'); // contoh: Jul 2025
            $labels[] = $label;

            $pending[] = Returns::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('status', 'pending')
                ->count();

            $success[] = Returns::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('status', 'success')
                ->count();
        }

        return response()->json([
            'labels' => $labels,
            'pending' => $pending,
            'success' => $success,
        ]);
    }
}
