@extends('layout')

@section('content')
    <h1>Add Book</h1>

    <!-- Form for adding a new book -->
    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="authors">Authors</label>
            <select name="authors[]" id="authors" class="form-control" multiple required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="published_date">Published Date</label>
            <input type="date" name="published_date" id="published_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
@endsection
