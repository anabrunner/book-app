<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BookControllerV1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $userId = Auth::id();
        $books = Book::forUser($userId)->paginate(12);
        return view('dashboard', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_read = $request->date_read;
        $book->shelf = $request->shelf;
        $book->cover = $request->hasFile('cover') ? $request->file('cover')->store('covers', 'public') : 'covers/default.png';
        $book->rating = $request->rating;
        $book->user_id = Auth::id();
        $book->save();
        return redirect()->route('dashboard')->with('success', 'Book saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.update', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_read = $request->date_read;
        $book->shelf = $request->shelf;
        if ($request->hasFile('cover')) {
            $book->cover = $request->file('cover')->store('covers', 'public');
        }
        $book->rating = $request->rating;
        $book->save();
        return redirect()->route('dashboard')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('dashboard')->with('success', 'Book deleted successfully!');
    }
}
