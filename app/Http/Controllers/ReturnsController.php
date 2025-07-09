<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Returns;
use Auth;

class ReturnsController extends Controller
{
    public function index()
    {
        $returns = Returns::with('lending.book')->where('user_id', Auth::id())->latest()->get();

        return view('return', compact('returns'));
    }

    public function show($id)
    {
        $return = Returns::with('lending.book')->where('user_id', Auth::id())->findOrFail($id);
        $returns = Returns::with('lending.book')->where('user_id', Auth::id())->latest()->get();

        return view('return_detail', compact('return','returns'));
    }
}
