<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('books')->where('user_id',Auth::id())->latest()->get();

        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('books')->where('user_id',Auth::id())->findOrFail($id);

        return view('order_detail', compact('order'));
    }
}
