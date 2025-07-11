<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

// import buat laporan 
use Illuminate\Support\Facades\Response;


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
    public function exportCSV()
    {
        $orders = Order::with('user')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];

        $columns = ['Order ID', 'User Name','Total Price', 'Status', 'Created At'];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    optional($order->user)->name,
                    $order->total_price,
                    $order->status,
                    $order->created_at->format('d-m-Y'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
