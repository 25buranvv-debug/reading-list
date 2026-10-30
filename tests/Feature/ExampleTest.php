<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
        $response->assertSee('No books yet');
    }

    public function test_can_view_create_book_page(): void
    {
        $response = $this->get('/books/create');

        $response->assertStatus(200);
        $response->assertSee('Add a New Book');
    }

    public function test_can_create_a_book(): void
    {
        $response = $this->post('/books', [
            'title' => 'Atomic Habits',
            'author' => 'James Clear',
            'status' => 'reading',
        ]);

        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', [
            'title' => 'Atomic Habits',
            'author' => 'James Clear',
            'status' => 'reading',
        ]);
    }

    public function test_create_book_validation_fails_with_invalid_data(): void
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => '',
            'status' => 'invalid-status',
        ]);

        $response->assertSessionHasErrors(['title', 'author', 'status']);
    }

    public function test_can_view_edit_book_page(): void
    {
        $book = Book::create([
            'title' => 'Deep Work',
            'author' => 'Cal Newport',
            'status' => 'to-read',
        ]);

        $response = $this->get("/books/{$book->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Edit Book');
        $response->assertSee('Deep Work');
        $response->assertSee('Cal Newport');
    }

    public function test_can_update_a_book(): void
    {
        $book = Book::create([
            'title' => 'Deep Work',
            'author' => 'Cal Newport',
            'status' => 'to-read',
        ]);

        $response = $this->put("/books/{$book->id}", [
            'title' => 'Deep Work (Updated)',
            'author' => 'Cal Newport',
            'status' => 'finished',
        ]);

        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Deep Work (Updated)',
            'status' => 'finished',
        ]);
    }

    public function test_update_book_validation_fails_with_invalid_data(): void
    {
        $book = Book::create([
            'title' => 'Deep Work',
            'author' => 'Cal Newport',
            'status' => 'to-read',
        ]);

        $response = $this->put("/books/{$book->id}", [
            'title' => '',
            'author' => '',
            'status' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['title', 'author', 'status']);
    }

    public function test_can_delete_a_book(): void
    {
        $book = Book::create([
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'status' => 'finished',
        ]);

        $response = $this->delete("/books/{$book->id}");

        $response->assertRedirect('/books');
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    public function test_list_page_contains_delete_confirmation(): void
    {
        $book = Book::create([
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'status' => 'finished',
        ]);

        $response = $this->get('/books');

        $response->assertStatus(200);
        $response->assertSee("confirm('Are you sure?')", false);
    }
}
