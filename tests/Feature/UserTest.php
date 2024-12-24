<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_user_account(): void
    {
        $response = $this->postJson('/api/users', [
            "name" => "Leonel Silvera",
            "email" => "cuentanueva@gmail.com",
            "password" => "password"
        ]);

        $this->assertDatabaseHas("users", [
            "name" => "Leonel Silvera",
            "email" => "cuentanueva@gmail.com",
        ]);

        $user = User::where("email", "cuentanueva@gmail.com")->firstOrFail();

        $this->assertTrue(Hash::check("password", $user->password));

        $response->assertStatus(201);
    }

    public function test_invalid_fields_user(): void
    {
        $response = $this->postJson('/api/users', [
            "name" => "",
            "email" => "",
            "password" => "123"
        ]);

        $this->assertDatabaseCount("users", 0);
        $response->assertStatus(422);
    }
}
