@extends('layout')

@section('content')
<header>
    <h1>Reading List</h1>
    <p>Keep track of the books you want to read, are reading, or have finished.</p>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
