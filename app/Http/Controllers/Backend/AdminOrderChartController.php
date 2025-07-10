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
        $start = now()->subDays(6);
        $end = now();

        $labels = [];
        $pending = [];
        $success = [];

        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            $tanggal = $date->format('Y-m-d');
            $labels[] = $tanggal;

            $pending[] = Order::whereDate('created_at', $tanggal)
                ->where('status', 'pending')
                ->count();

            $success[] = Order::whereDate('created_at', $tanggal)
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
