@extends('layout')

@section('content')
<header>
    <div class="top-bar">
        <div>
            <h1>Reading List</h1>
            <p>Keep track of the books you want to read, are reading, or have finished.</p>
        </div>
        <div>
            <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add book</a>
        </div>
    </div>
</header>

<div class="card">
    @if($books->isEmpty())
        <div class="empty-state">
            <h3>No books yet</h3>
            <p>Your reading list is currently empty.</p>
        </div>
    @else
        <table class="books-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td class="book-title">{{ $book->title }}</td>
                        <td class="book-author">{{ $book->author }}</td>
                        <td>
                            <span class="badge badge-{{ $book->status }}">
                                {{ str_replace('-', ' ', $book->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('books.edit', $book) }}" class="btn-edit">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
