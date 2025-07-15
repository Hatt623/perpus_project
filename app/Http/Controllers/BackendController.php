<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\Returns;
use App\Models\User;

class BackendController extends Controller
{
    public function index()
    {
       

        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalReturns = Returns::count();
        $totalUsers = user::all();

        return view('backend.index', compact('totalBooks', 'totalOrders', 'totalReturns','totalUsers'));    
    }
}
