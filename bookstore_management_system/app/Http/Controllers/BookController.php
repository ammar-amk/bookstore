<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
{
    $search = $request->query('search');
    $booksQuery = Book::with('authors');

    if ($search) {
        $booksQuery->where('title', 'like', '%'.$search.'%')
            ->orWhereHas('authors', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
    }

    $books = $booksQuery->paginate(10); // Change '10' to the desired number of books per page

    return view('books.index', compact('books', 'search'));
}


    public function create()
    {
        $authors = Author::all();

        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'authors' => 'required|array',
        'authors.*' => 'exists:authors,id',
        'description' => 'required',
        'price' => 'required|numeric',
        'published_date' => 'required|date',
    ]);

    $book = new Book();
    $book->title = $validatedData['title'];
    $book->description = $validatedData['description'];
    $book->price = $validatedData['price'];
    $book->published_date = $validatedData['published_date'];

    $book->save();

    $book->authors()->attach($validatedData['authors']);

    return redirect()->route('books.index')->with('success', 'Book added successfully.');
}
    public function show(Book $book)
    {
        // Show the details of a specific book
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
{
    $authors = Author::all();

    return view('books.edit', compact('book', 'authors'));
}

public function update(Request $request, Book $book)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'authors' => 'required|array',
        'authors.*' => 'exists:authors,id',
        'description' => 'required',
        'price' => 'required|numeric',
        'published_date' => 'required|date',
    ]);

    $book->title = $validatedData['title'];
    $book->description = $validatedData['description'];
    $book->price = $validatedData['price'];
    $book->published_date = $validatedData['published_date'];

    $book->save();

    $book->authors()->sync($validatedData['authors']);

    return redirect()->route('books.index')->with('success', 'Book updated successfully.');
}

    public function destroy(Book $book)
    {
        // Delete a book
        $book->authors()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
