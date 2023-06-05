@extends('layout')

@section('content')
    <h1>Books</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form action="{{ route('books.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by title or author" value="{{ $search }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Book listing table -->
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Authors</th>
                <th>Description</th>
                <th>Price</th>
                <th>Published Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>
                        @foreach($book->authors as $author)
                            {{ $author->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ $book->description }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->published_date }}</td>
                    <td>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination links -->
    {{ $books->links() }}

    <!-- Create new book button -->
    <a href="{{ route('books.create') }}" class="btn btn-primary mt-3">Add Book</a>
@endsection
