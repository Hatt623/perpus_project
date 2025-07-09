<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Genre;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::latest()->get();    

        $title = 'Delete Data';
        $text = 'Are you Sure?';
        confirmDelete($title,$text);

        return view('backend.genre.index', compact ('genre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres',
        ]);

        // Nama di tabel        Nama di Form
        $genre              = new Genre();
        $genre->name        = $request->name;
        $genre->slug        = Str::slug($request->name, '-');   

        $genre->save();
        toast('Data Successfully saved', 'success');
        return redirect()->route('backend.genre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view('backend.genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:genres'

        ]);

        // Data tabel         Data Form
        $genre              = Genre::findOrFail($id);  
        $genre->name        = $request->name;
        $genre->slug        = Str::slug($request->name, '-');

        $genre->save();
        toast('Data successfully edited', 'success');
        return redirect()->route('backend.genre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        toast('Data successfully deleted', 'success');
        return redirect()->route('backend.genre.index');
    }
}
