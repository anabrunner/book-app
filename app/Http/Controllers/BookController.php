<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $user_id = Auth::id();
        $books = DB::select('select * from books where user_id = ?', [$user_id]);
        return view('dashboard', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_read = $request->date_read;
        $book->shelf = $request->shelf;
        $book->cover = $request->cover;
        $book->rating = $request->rating;
        $book->save();
        return response()->json($book);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_read = $request->date_read;
        $book->shelf = $request->shelf;
        $book->cover = $request->cover;
        $book->rating = $request->rating;
        $book->save();
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return response()->json(["message" => "book deleted"]);
    }
}
