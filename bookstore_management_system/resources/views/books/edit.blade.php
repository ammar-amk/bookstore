@extends('layout')

@section('content')
    <h1>Edit Book</h1>

    <!-- Form for editing the book -->
    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="form-group">
            <label for="authors">Authors</label>
            <select name="authors[]" id="authors" class="form-control" multiple required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" @if($book->authors->contains($author->id)) selected @endif>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $book->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $book->price }}" required>
        </div>

        <div class="form-group">
            <label for="published_date">Published Date</label>
            <input type="date" name="published_date" id="published_date" class="form-control" value="{{ $book->published_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
@endsection
