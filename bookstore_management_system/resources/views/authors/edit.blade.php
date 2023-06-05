@extends('layout')

@section('content')
    <h1>Edit Author</h1>

    <!-- Display validation errors, if any -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Author edit form -->
    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $author->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $author->email }}" required>
        </div>
        <div class="form-group">
            <label for="biography">Biography:</label>
            <textarea class="form-control" id="biography" name="biography" rows="5" required>{{ $author->biography }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Author</button>
    </form>
@endsection
