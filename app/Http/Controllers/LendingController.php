<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Lending;
use App\Models\Book;
use App\Models\Returns;
use Auth;


class LendingController extends Controller
{
    public function index()
    {
        $lendingItems = Lending::with('book')->where('user_id', auth()->id())->get();

        return view('lending', compact('lendingItems'));
    }

    public function addToLending(Request $request, $id)
    {
        if(!Auth::check())
        {
            toast('Please Login first','warning');
            return redirect('/login');
        }
        
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $lending = Lending::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->first();

        if($lending)
        {
            $lending -> increment('qty', $request->qty);
        }

        else{
            Lending::create([
                'user_id'   => auth::id(),
                'book_id'   => $id,
                'deadline'  => now()->addDays(7), // Set deadline 7 days from now
                'qty'       => $request->qty,
                'status'    => 'pending',
            ]);
        }

        toast('Lended Book successfully added to Lending', 'success');
        return back();
    }

    public function updateLending(Request $request, $id)
    {
        $lendingItems = Lending::findOrFail($id);

        $book = Book::findOrFail($lendingItems->book_id);

        $request->validate([
            'qty' => 'required|integer|min:1|max:' . $book->stock,  
        ]);

        $lendingItems->qty = $request->qty;
        $lendingItems->save();

        toast('Lending successfully updated', 'success');
        return redirect()->route('lending.index');
    }
    
     public function remove($id)
    {
        $lending = Lending::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $lending->delete();
        toast('Lended Book successfully removed from Lending', 'success');
        return redirect()->route('lending.index');
    }

    public function lend()
    {
        $lendingItems = Lending::with('book')->where('user_id', auth()->id())->get();
        if ($lendingItems->isEmpty()) {
            toast('Lending is empty, please fill your Lending', 'warning');
            return redirect()->route('lending.index');
        }

        $lendCode = 'LND-' . strtoupper(Str::random(8));

        // Simpan peminjaman ke tabel returns
       foreach ($lendingItems as $item){
            for ($i = 0; $i < $item->qty; $i++) {
                Returns::create([
                    'lending_id'    => $item->id,
                    'user_id'       => auth()->id(),
                    'book_id'       => $item->book_id,
                    'lend_code'     => $lendCode,
                    'returned_at'   => now()->addDays(7),
                    'fines'         => 0,
                    'book_status'   => 'good',
                    'status'        => 'pending',
                    'lending_status'=> null,
                ]);
            }
        }


        // Simpan detail Lending ke order_lendings`
        // Attcach untuk nambah, detach menghapus, sync untuk update <- (bila pake pivot (Many to many) pakai ini)
        foreach ($lendingItems as $item) {
            $book = Book::find($item->book_id);

            // Skip buku yang status-nya bukan 'Good'
            if ($book->status !== 'Good') {
                continue; 
            }

            // Kurangi stok
            $book->stock -= $item->qty;
            $book->save();
        }

        // Hapus isi Lending
        Lending::where('user_id', auth()->id())->delete();

        toast('Lending successfully added!', 'success');
        return redirect()->route('lending.index');
    }
}
