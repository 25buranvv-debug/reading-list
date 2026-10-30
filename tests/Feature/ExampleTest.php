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
}
