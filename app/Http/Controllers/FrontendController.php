<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Book;

class FrontendController extends Controller
{
    public function index()
    {
        $book = Book::latest()->take(8)->get();
        $latestBooks = Book::latest()->take(3)->get();

        return view('index', compact('book','latestBooks'));
    }

    public function book()
    {
        $genre = Genre::all();
        $book = Book::latest()->get();
        return view('book', compact('book','genre'));
    }

    public function singleBook(Book $book)
    {
        return view('single_book', compact('book'));
    }

    public function filterByCategory($slug)
    {
        $genre = Genre::all();
        $selectedGenre = Genre::where('slug', $slug)->firstOrFail();
        $book = $selectedGenre->book()->latest()->get();
        return view('book',compact('book','genre','selectedGenre'));
    }

    public function search()
    {
        $query = request('q');

        $book = Book::where('title','like','%'. $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhereHas('genre', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');

            })
            ->latest()
            ->get();

            $genre = Genre::all(); //Untuk sidebar/filter kategori jika dibutuhkan

            return view('book', compact('book', 'genre','query'));
    }
}
