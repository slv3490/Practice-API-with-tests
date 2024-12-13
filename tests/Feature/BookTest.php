<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    
    //GET ALL BOOKS
    public function test_get_all_books(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route("books.index"));

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'message' => "Acción realizada exitosamente."
        ]);
    }

    //CAN NOT GET ALL BOOKS

    public function test_can_not_get_all_books(): void
    {
        $response = $this->getJson(route("books.index"));

        $response->assertStatus(401);
    }

    //Create

    public function test_can_create_a_book(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route("books.store"), [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 2024,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $response->assertStatus(200);

        $response->assertValid(['title', 'published_year']);

        $response->assertExactJson([
            "success" => true,
            "data" => [
                "title" => "Un titulo loren ipsum dolor a acts",
                "author" => "Leonel Enrique Silvera",
                "published_year" => 2024,
                "status" => "disponible",
                "borrowed_at" => "2024-12-12",
                "id" => 1
            ],
            "message" => "Acción realizada exitosamente."
        ]);
        $this->assertDatabaseCount("books", 1);
        $this->assertDatabaseHas("books", [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 2024,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);
    }

    public function test_invalid_validation_for_create_a_book() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route("books.store"), [
            "title" => "",
            "author" => "Leonel Enrique Silvera",
            "published_year" => "",
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $response->assertStatus(422);

        $response->assertInvalid(['title', 'published_year']);
        $this->assertDatabaseMissing("books", [
            "id" => 1,
            "title" => "",
            "author" => "Leonel Enrique Silvera",
            "published_year" => "",
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);
        $this->assertDatabaseCount("books", 0);
    }

    //SHOW

    public function test_display_the_specified_resource(): void
    {
        $user = User::factory()->create();

        Book::create([
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 2024,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $response = $this->actingAs($user)->getJson(route("books.show", 1));
        
        $response->assertStatus(200);

        $response->assertExactJson([
            "success" => true,
            "data" => [
                "title" => "Un titulo loren ipsum dolor a acts",
                "author" => "Leonel Enrique Silvera",
                "published_year" => 2024,
                "status" => "disponible",
                "borrowed_at" => "2024-12-12",
                "id" => 1
            ],
            "message" => "Acción realizada exitosamente."
        ]);

        $this->assertDatabaseCount("books", 1);
        $this->assertDatabaseHas("books", [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 2024,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);
    }

    //UPDATE A BOOK
    public function test_can_update_a_book(): void
    {
        $user = User::factory()->create();

        Book::create([
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 1940,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $this->assertDatabaseHas("books", [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 1940,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $response = $this->actingAs($user)->putJson(route("books.update", 1), [
            "title" => "Un titulo comun",
            "author" => "Martin Torres",
            "published_year" => 2024,
            "status" => "prestado",
            "borrowed_at" => "2024-10-12"
        ]);

        $response->assertStatus(200);

        $response->assertValid(['title', 'published_year']);

        $response->assertExactJson([
            "success" => true,
            "data" => [
                "title" => "Un titulo comun",
                "author" => "Martin Torres",
                "published_year" => 2024,
                "status" => "prestado",
                "borrowed_at" => "2024-10-12",
                "id" => 1
            ],
            "message" => "Acción realizada exitosamente."
        ]);
        $this->assertDatabaseCount("books", 1);
        $this->assertDatabaseHas("books", [
            "title" => "Un titulo comun",
            "author" => "Martin Torres",
            "published_year" => 2024,
            "status" => "prestado",
            "borrowed_at" => "2024-10-12"
        ]);
    }

    //DELETE

    public function test_can_delete_a_book(): void
    {
        $user = User::factory()->create();

        Book::create([
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 1940,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $this->assertDatabaseHas("books", [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 1940,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $response = $this->actingAs($user)->deleteJson(route('books.destroy', 1));

        $response->assertStatus(200);

        $this->assertDatabaseMissing("books", [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 1940,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);
    }

    //FILTERED

    public function test_can_filter_a_book() : void
    {
        $user = User::factory()->create();

        Book::create([
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 1940,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);
        Book::factory()->count(9)->create();

        $this->assertDatabaseCount("books", 10);
        
        $response = $this->actingAs($user)->postJson(route("books.filtered"), [
            "author" => "Enrique"
        ]);

        $response->assertStatus(200);

        $response->assertExactJson([
            "success" => true,
            "data" => [
                "title" => "Un titulo loren ipsum dolor a acts",
                "author" => "Leonel Enrique Silvera",
                "published_year" => 1940,
                "status" => "disponible",
                "borrowed_at" => "2024-12-12",
                "id" => 1
            ],
            "message" => "Acción realizada exitosamente."
        ]);
    }
}
