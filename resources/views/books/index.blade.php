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
    <div style="display: flex; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color); gap: 8px; flex-wrap: wrap;">
        <span style="font-weight: 600; color: var(--text-muted); font-size: 14px; margin-right: 4px;">Filter:</span>
        <a href="{{ route('books.index') }}" class="filter-link {{ empty($status) ? 'active' : '' }}">All</a>
        <span style="color: var(--text-muted);">·</span>
        <a href="{{ route('books.index', ['status' => 'to-read']) }}" class="filter-link {{ $status === 'to-read' ? 'active' : '' }}">To read</a>
        <span style="color: var(--text-muted);">·</span>
        <a href="{{ route('books.index', ['status' => 'reading']) }}" class="filter-link {{ $status === 'reading' ? 'active' : '' }}">Reading</a>
        <span style="color: var(--text-muted);">·</span>
        <a href="{{ route('books.index', ['status' => 'finished']) }}" class="filter-link {{ $status === 'finished' ? 'active' : '' }}">Finished</a>
    </div>

    @if($books->isEmpty())
        <div class="empty-state">
            @if(!empty($status))
                <h3>No books found</h3>
                <p>No books currently marked as "{{ str_replace('-', ' ', $status) }}".</p>
                <div style="margin-top: 12px;">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary btn-sm">Clear Filter</a>
                </div>
            @else
                <h3>No books yet</h3>
                <p>Your reading list is currently empty.</p>
            @endif
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
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger-link">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
