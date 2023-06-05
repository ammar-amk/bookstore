<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
{
    $search = request()->input('search');
    $authors = Author::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })
        ->paginate(10);

    return view('authors.index', compact('authors', 'search'));
}

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:authors',
            'biography' => 'required',
        ]);

        // Create a new author instance
        $author = new Author();
        $author->name = $request->input('name');
        $author->email = $request->input('email');
        $author->biography = $request->input('biography');

        // Save the author
        $author->save();

        // Redirect to the index page with a success message
        return redirect()->route('authors.index')->with('success', 'Author added successfully.');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:authors,email,' . $author->id,
            'biography' => 'required',
        ]);

        // Update the author details
        $author->name = $request->input('name');
        $author->email = $request->input('email');
        $author->biography = $request->input('biography');

        // Save the author
        $author->save();

        // Redirect to the author show page with a success message
        return redirect()->route('authors.show', $author->id)->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        // Deletion logic for the author
    }
}
