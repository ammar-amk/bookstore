@extends('layout')

@section('content')
    <h1>Author Details</h1>

    <!-- Display author details -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $author->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $author->email }}</p>
            <p class="card-text"><strong>Biography:</strong> {{ $author->biography }}</p>
        </div>
    </div>
    <!-- Delete button -->
    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this author?')">Delete Author</button>
    </form>


    <!-- Back to index button -->
    <a href="{{ route('authors.index') }}" class="btn btn-primary mt-3">Back to Authors</a>
@endsection
