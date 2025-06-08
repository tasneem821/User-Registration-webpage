<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\RegisteredUsers;
use App\Mail\NewUserRegistered;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;



/** @test */
public function user_can_register_successfully()
{
    Storage::fake('public');

    $response = $this->post('/register', [
        'fullname' => 'Tasneem Gomaa',
        'username' => 'tasneemgomaa',
        'phone' => '01012345678',
        'whats' => '01012345678',
        'address' => 'Cairo, Egypt',
        'password' => 'Pass@1234',
        'password_confirmation' => 'Pass@1234',
        'email' => 'tasneem@example.com',
        'imageUpload' => UploadedFile::fake()->image('avatar.jpg'), // ← this line fixes the error
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'User registered successfully!');
    $this->assertDatabaseHas('registered_users', ['username' => 'tasneemgomaa']);
}
    /** @test */
    public function registration_fails_with_invalid_email()
    {
        $response = $this->post('/register', [
            'fullname' => 'Test User',
            'username' => 'testuser',
            'phone' => '01000000000',
            'whats' => '01000000000',
            'address' => 'Address',
            'password' => 'Pass@1234',
            'password_confirmation' => 'Pass@1234',
            'email' => 'invalid-email',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function registration_fails_with_weak_password()
    {
        $response = $this->post('/register', [
            'fullname' => 'Test User',
            'username' => 'testuser2',
            'phone' => '01000000001',
            'whats' => '01000000001',
            'address' => 'Address',
            'password' => 'password', // no symbols or numbers
            'password_confirmation' => 'password',
            'email' => 'user2@example.com',
        ]);

        $response->assertSessionHasErrors('password');
    }

        /** @test */
    public function it_hashes_the_password()
    {
        $user = RegisteredUsers::create([
            'fullname' => 'Test Hashed User',
            'username' => 'hasheduser',
            'phone' => '01088888888',
            'whats' => '01088888888',
            'address' => 'Test',
            'password' => bcrypt('Pass@1234'),
            'email' => 'hashed@example.com',
            'imageUpload' => 'dummy.jpg',
        ]);

        $this->assertNotEquals('Pass@1234', $user->password);
    }

}
