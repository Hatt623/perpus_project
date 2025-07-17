<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class AdminOrderChartController extends Controller
{
    public function getAdminOrderChartData()
    {
        $labels = [];
        $pending = [];
        $success = [];

        // logika for ambil 12 bulan terakhir
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->startOfMonth();
            $label = $month->format('M Y');
            $labels[] = $label;

            $pending[] = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('status', 'pending')
                ->count();

            $success[] = Order::whereMonth('created_at', $month->month)
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
