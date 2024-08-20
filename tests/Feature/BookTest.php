<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Common authenticated user for tests
        $this->user = User::factory()->create();
    }

    /**
     * Test for displaying book index.
     */
    public function test_index_displays_books(): void
    {
        Book::factory()->count(3)->create();
        $response = $this->actingAs($this->user)->get(route("dashboard"));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('books');
    }

    /**
     * Test for showing create book form.
     */
    public function test_create_displays_create_form(): void
    {
        $response = $this->actingAs($this->user)->get(route('v1.books.create'));
        $response->assertStatus(200);
        $response->assertViewIs('books.create');
    }

    /**
     * Test for storing a new book.
     */
    public function test_store_saves_new_book(): void
    {
        $book = Book::factory()->make()->toArray();
        $response = $this->actingAs($this->user)
            ->post(route('v1.books.store'), $book);
        $response->assertRedirect(route('dashboard'));

        // Get the stored book
        $savedBook = Book::latest()->first();
        // Assert that the cover file was stored
        Storage::disk('public')->assertExists($savedBook->cover);
        // Check that all entries were correctly saved to database
        $this->assertDatabaseHas('books', [
            'title' => $savedBook['title'],
            'author' => $savedBook['author'],
            'date_read' => $savedBook['date_read'],
            'shelf' => $savedBook['shelf'],
            'cover' => $savedBook->cover,
            'rating' => $savedBook['rating'],
            'user_id' => $this->user->id
        ]);
    }

    /**
     * Test for showing edit book form for authorized users.
     */
    public function test_edit_displays_edit_form_if_user_authorized(): void
    {
        // Ensures that book is created by auth user
        $book = Book::factory()->create(['user_id' => $this->user->id]);
        $response = $this->actingAs($this->user)
            ->get(route('v1.books.edit', ['book'=> $book->id]));
        $response->assertStatus(200);
        $response->assertViewIs('books.update');
        $response->assertViewHas('book', $book);
    }

    /**
     * Test for showing edit book form for unauthorized users.
     */
    public function test_edit_does_not_display_edit_form_if_user_not_authorized(): void
    {
        $authorizedUser = User::factory()->create();
        $unauthorizedUser = User::factory()->create();
        // Create book that belongs to authorized user.
        $book = Book::factory()->create(['user_id' => $authorizedUser->id]);
        // Act as unauthorized user
        $response = $this->actingAs($unauthorizedUser)
            ->get(route('v1.books.edit', ['book' => $book->id]));
        // Assert that access is forbidden.
        $response->assertStatus(403);
    }

    /**
     * Test for updating book for authorized users.
     */
    public function test_update_modifies_book_for_authorized_user(): void
    {
        // Ensures book is created by authorized user
        $book = Book::factory()->create(['user_id'=> $this->user->id]);
        $date = now();
        $newData = [
            'title' => 'updated title',
            'author' => 'updated author',
            'date_read' => $date,
            'shelf' => 'updated shelf',
            'cover' => UploadedFile::fake()->image('newcover.jpg'),
            'rating' => 3
        ];
        $response = $this->actingAs($this->user)
            ->patch(route('v1.books.update', ['book'=> $book->id]), $newData);
        $response->assertRedirect(route('dashboard'));
        
        // Get the updated book
        $updatedBook = Book::latest('updated_at')->first();
        // Assert that the updated cover file was stored
        Storage::disk('public')->assertExists($updatedBook->cover);
        // Check all entries were correctly updated on the database
        $this->assertDatabaseHas('books', [
            'title' => $updatedBook['title'],
            'author' => $updatedBook['author'],
            'date_read' => $updatedBook['date_read'],
            'shelf' => $updatedBook['shelf'],
            'cover' => $updatedBook->cover,
            'rating' => $updatedBook['rating'],
        ]);
    }

    /**
     * Test for updating book for unauthorized users.
     */
    public function test_update_does_not_modify_book_for_unauthorized_user(): void
    {
        $authorizedUser = User::factory()->create();
        $unauthorizedUser = User::factory()->create();
        // Create book that belongs to authorized user.
        $book = Book::factory()->create(['user_id' => $authorizedUser->id]);
        $date = now();
        $newData = [
            'title' => 'updated title',
            'author' => 'updated author',
            'date_read' => $date,
            'shelf' => 'updated shelf',
            'cover' => UploadedFile::fake()->image('newcover.jpg'),
            'rating' => 3
        ];
        // Act as unauthorized user
        $response = $this->actingAs($unauthorizedUser)
            ->patch(route('v1.books.update', ['book'=> $book->id]), $newData);
        // Assert that access is forbidden.
        $response->assertStatus(403);
    }

    /**
     * Test for deleting a book for authorized users.
     */
    public function test_destroy_deletes_book_for_authorized_user(): void
    {
        // Ensures book is created by authorized user
        $book = Book::factory()->create(['user_id'=> $this->user->id]);
        $response = $this->actingAs($this->user)
            ->delete(route('v1.books.destroy', ['book'=> $book->id]));
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * Test for deleting a book for unauthorized users.
     */
    public function test_destroy_does_not_delete_book_for_unauthorized_user(): void
    {
        $authorizedUser = User::factory()->create();
        $unauthorizedUser = User::factory()->create();
        // Create book that belongs to authorized user.
        $book = Book::factory()->create(['user_id' => $authorizedUser->id]);
        // Act as unauthorized user
        $response = $this->actingAs($unauthorizedUser)
            ->delete(route('v1.books.destroy', ['book'=> $book->id]));
        // Assert that access is forbidden.
        $response->assertStatus(403);
    }
}
