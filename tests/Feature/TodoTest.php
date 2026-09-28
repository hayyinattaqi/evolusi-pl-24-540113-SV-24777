<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_page_can_be_accessed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_api_todos_mengembalikan_json(): void
    {
        Todo::create(['title' => 'Belajar Vue', 'is_done' => false]);

        $response = $this->getJson('/api/todos');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Belajar Vue']);
    }
}