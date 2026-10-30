@extends('layout')

@section('content')
<header>
    <h1>Add a New Book</h1>
    <p>Add a book to your reading list.</p>
</header>

<div class="card">
    @if ($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. The Great Gatsby" required maxlength="255">
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}" placeholder="e.g. F. Scott Fitzgerald" required maxlength="255">
            @error('author')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="to-read" {{ old('status', 'to-read') === 'to-read' ? 'selected' : '' }}>To read</option>
                <option value="reading" {{ old('status') === 'reading' ? 'selected' : '' }}>Reading</option>
                <option value="finished" {{ old('status') === 'finished' ? 'selected' : '' }}>Finished</option>
            </select>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 12px; margin-top: 24px;">
            <button type="submit" class="btn btn-primary">Save Book</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
