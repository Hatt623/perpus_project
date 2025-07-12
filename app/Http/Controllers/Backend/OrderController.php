<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

use Carbon\Carbon;

// import buat laporan 
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();

        $title = 'Remove Orders';
        $text = 'Are you sure you want to remove this order?';
        confirmDelete($title,$text);

        return view('backend.order.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::with('user')->findOrFail($id);

        return view('backend.order.show', compact('order'));
    }

    public function orderReports(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();
        return view('backend.order.reports', compact('orders'));
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order -> books()->detach();
        $order -> delete();

        toast('Order removed successfully', 'success');
        return redirect()->route('backend.orders.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success,cancel',
        ]);

        $order          = Order::findOrFail($id);
        $order->status  = $request->status;

        $order->save();
        toast('Order status updated successfully', 'success');
        return redirect()->route('backend.orders.show', $id);
    }

    // Laporan
    //CSV
   public function exportCSV(Request $request)
    {
        $query = Order::with('user');

        //  Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        //  Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];

        $columns = ['No', 'User Name','Total Price', 'Status', 'Created At'];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $No = 1;
            foreach ($orders as $order) {
                fputcsv($file, [
                    $No++,
                    $order->order_code,
                    optional($order->user)->name,
                    $order->total_price,
                    $order->status,
                    $order->created_at->format('d M Y'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    // PDF
    public function exportPDF(Request $request)
    {
        $query = Order::with('user');

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $pdf = Pdf::loadView('backend.order.pdf', compact('orders'))->setPaper('a4','landscape');

        return $pdf->download('orders.pdf');
    }
}
