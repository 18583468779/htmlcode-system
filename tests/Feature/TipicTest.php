<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class TipicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->actingAs(User::find(3))->postJson('/tipic', ['title' => 'test', 'content' => 'test content']);
        $response->dump();
        $response->assertStatus(200);
    }
}