<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

use Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::latest()->get();
        $title = 'Delete Data';
        $text = 'Are you Sure?';
        confirmDelete($title,$text);

        return view('backend.book.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        return view('backend.book.create',compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'genre_id' => 'required|',
            'title' => 'required|',
            'writer' => 'required|',
            'publisher' => 'required|',
            'image'         => 'required|image|mimes:jpg,png|max:3024',
            'description' => 'required|max:2000',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'status'=> 'required|in:Good,Bad'
        ]);

        $book = new Book();
        $book ->genre_id        = $request->genre_id;
        $book ->title           = $request->title;
        $book ->writer           = $request->writer;
        $book ->slug            = Str::slug($request->title, '-');
        $book ->publisher       = $request->publisher;
        $book ->description     = $request->description;
        $book ->price           = $request->price;
        $book ->stock           = $request->stock;
        $book ->status          = $request->status;

        if ($request->hasFile('image')) {
            $file           = $request->file('image');
            $randomName     = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path           = $file->storeAs('Books', $randomName, 'public');
            // memasukkan nama image nya ke database
            $book->image = $path;
        }

        $book->save();
        toast('Data Successfully added', 'success');
        return redirect()->route('backend.book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('backend.book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $genre = Genre::all();

        return view('backend.book.edit', compact('book','genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'genre_id' => 'required|',
            'title' => 'required|',
            'writer' => 'required|',
            'publisher' => 'required|',
            'image'         => 'image|mimes:jpg,png|max:3024',
            'description' => 'required|max:2000',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'status'=> 'required|in:Good,Bad'
        ]);

        $book = Book::findOrFail($id);
        $book ->genre_id        = $request->genre_id;
        $book ->title           = $request->title;
        $book ->writer           = $request->writer;
        $book ->slug            = Str::slug($request->title, '-');
        $book ->publisher       = $request->publisher;
        $book ->description     = $request->description;
        $book ->price           = $request->price;
        $book ->stock           = $request->stock;
        $book ->status          = $request->status;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($book->image);

            $file           = $request->file('image');
            $randomName     = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path           = $file->storeAs('Books', $randomName, 'public');
            // memasukkan nama image nya ke database
            $book->image = $path;
        }

        $book->save();
        toast('Data Successfully updated', 'success');
        return redirect()->route('backend.book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        Storage::disk('public')->delete($book->$image);
        $book->delete();
        toast('Data successfully removed', 'success');
        return redirect()->route('backend.book.index');
    }
}
