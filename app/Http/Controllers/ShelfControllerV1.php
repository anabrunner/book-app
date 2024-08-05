<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShelfControllerV1 extends Controller
{
    public function index(): View
    {
        // Retrieves unique shelf names from the books table
        $userId = Auth::id();
        $shelves = Book::forUser($userId)
            ->select('shelf')
            ->distinct()
            ->pluck('shelf');

        // Retrieves the first book for each shelf
        $shelfBooks = [];
        foreach ($shelves as $shelf) {
            $book = Book::forUser($userId)
                ->where('shelf', $shelf)
                ->orderBy('created_at')
                ->first();
            $shelfBooks[$shelf] = $book;
        }
        return view('shelves.index', compact('shelves', 'shelfBooks'));
    }

    public function showBooks($shelf): View
    {
        // Retrieves books for specified shelf
        $userId = Auth::id();
        $books = Book::forUser($userId)
            ->byShelf($shelf)
            ->get();
        return view('shelves.books', compact('books', 'shelf'));
    }
}
