<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

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
}
