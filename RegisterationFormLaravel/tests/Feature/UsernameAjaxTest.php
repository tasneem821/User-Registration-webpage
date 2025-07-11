<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\RegisteredUsers;

class UsernameAjaxTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_empty_string_when_username_does_not_exist()
    {
        $response = $this->get('/check-username?username=testuser');
        $response->assertStatus(200);
        $response->assertSee('');
    }
    
    public function test_returns_error_message_when_username_exists()
{

    RegisteredUsers::factory()->create([
        'username' => 'existinguser' 
    ]);

    $response = $this->get('/check-username?username=existinguser');
    
    $response->assertStatus(200);
    $response->assertSee('Username already exists. Please choose another one.');
}
}
