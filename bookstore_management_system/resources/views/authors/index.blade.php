@extends('layout')

@section('content')
    <h1>Authors</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form action="{{ route('authors.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ $search }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Author listing table -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Biography</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->biography }}</td>
                    <td>
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No authors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination links -->
    {{ $authors->links() }}

    <!-- Create new author button -->
    <a href="{{ route('authors.create') }}" class="btn btn-primary mt-3">Add Author</a>
@endsection
