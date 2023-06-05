@extends('layout')

@section('content')
    <h1>Add Author</h1>

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

    <!-- Author creation form -->
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="biography">Biography:</label>
            <textarea class="form-control" id="biography" name="biography" rows="5" required>{{ old('biography') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Author</button>
    </form>
@endsection
