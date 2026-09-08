<?php

namespace Tests\Feature;

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
}