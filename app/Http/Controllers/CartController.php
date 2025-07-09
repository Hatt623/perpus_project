<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Book;
use Auth;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('book')->where('user_id', auth()->id())->get();

        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        if(!Auth::check())
        {
            toast('Please Login first','warning');
            return redirect('/login');
        }
        
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->first();

        if($cart)
        {
            $cart -> increment('qty', $request->qty);
        }

        else{
            Cart::create([
                'user_id'   => auth::id(),
                'book_id'   => $id,
                'qty'       => $request->qty
            ]);
        }

        toast('Book successfully added to cart', 'success');
        return back();
    }

    public function updateCart(Request $request, $id)
    {
        $cartItems = Cart::findOrFail($id);
        
        $book = Book::findOrFail($cartItems->book_id);

        $request->validate([
            'qty' => 'required|integer|min:1|max:' . $book->stock,
        ]);

        $cartItems->qty = $request->qty;
        $cartItems->save();

        toast('Cart successfully updated', 'success');
        return redirect()->route('cart.index');
    }
    
     public function remove($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->delete();
        toast('Book successfully removed from cart', 'success');
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cartItems = Cart::with('book')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) {
            toast('Cart is empty, please fill your cart', 'warning');
            return redirect()->route('cart.index');
        }

        // Hitung total harga
        $total = $cartItems->sum(function ($item) {
            return $item->qty * $item->book->price;
        });

        // Simpan order
        $order = Order::create([
            'user_id'    => auth()->id(),
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price'=> $total,
            'status'     => 'pending',
        ]);

        // Simpan detail order ke pivot `order_book`
        // Attcach untuk nambar, detach menghapus, sync untuk update <- (bila pake pivot (Many to many) pakai ini)
        foreach ($cartItems as $item) {
            // Kurangi stok
            $book = Book::find($item->book_id);
            $book->stock -= $item->qty;
            $book->save();

            $order->books()->attach($item->book_id, [
                'qty'   => $item->qty,
                'price' => $item->book->price,
            ]);
        }

        // Hapus isi keranjang
        Cart::where('user_id', auth()->id())->delete();

        toast('Order successfully added!', 'success');
        return redirect()->route('orders.index');
    }
}
