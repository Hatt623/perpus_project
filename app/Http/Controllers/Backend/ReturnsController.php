<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Returns;
use Auth;

class ReturnsController extends Controller
{
    public function index()
    {
        $returns = Returns::with('user')->latest()->get();

        $title = 'Delete Returns & Lendings';
        $text = 'Are you sure you want to delete this data?';
        confirmDelete($title, $text);

        return view('backend.return.index', compact('returns'));
    }

    public function show($id)
    {
       $return = Returns::with('user', 'lending.book')->findOrFail($id);
       return view('backend.return.show', compact('return'));
    }

    public function destroy($id)
    {
        $return = Returns::findOrFail($id);
        
        $return -> delete();
        toast('Data successfully deleted', 'success');
        return redirect()->route('backend.returns.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success,cancel',
            'book_status' => 'required|in:good,bad',
            'fines' => 'nullable|numeric|min:0',
            'lending_status' => 'required|in:borrowed,returned',
            

        ]);

        $return =   Returns::findOrFail($id);
        $return ->  status = $request->status;
        $return ->  book_status = $request->book_status;
        $return ->  lending_status = $request->lending_status;
        $return ->  returned_at = $return->returned_at;
        $return->fines = $return->calculateFines();

        $return->save();
        toast('Data updated successfully', 'success');
        return redirect()->route('backend.returns.show', $id);
    }
}
