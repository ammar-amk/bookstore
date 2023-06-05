@extends('layout')

@section('content')
    <h1>{{ $book->title }}</h1>

    <p><strong>Description:</strong> {{ $book->description }}</p>
    <p><strong>Price:</strong> ${{ $book->price }}</p>
    <p><strong>Published Date:</strong> {{ $book->published_date }}</p>

    <p><strong>Authors:</strong></p>
    <ul>
        @foreach($book->authors as $author)
            <li>{{ $author->name }}</li>
        @endforeach
    </ul>

    <!-- Delete Book Form -->
    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Book</button>
    </form>
@endsection
