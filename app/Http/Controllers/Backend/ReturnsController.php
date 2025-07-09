<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Returns;

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
       $return = Returns::with('user', 'books')->findOrFail($id);
       return view('backend.return.show', compact('return'));
    }

    public function destroy($id)
    {
        $return = Returns::findOrFail($id);
        
        // $return -> books()->
    }
}
