<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_todo_bisa_diakses(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_bisa_menambah_todo(): void
    {
        $response = $this->post('/todos', ['title' => 'Belajar CI/CD']);

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', ['title' => 'Belajar CI/CD']);
    }
}