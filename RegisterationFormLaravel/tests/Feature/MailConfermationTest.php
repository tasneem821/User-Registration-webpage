<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Mail\NewUserRegistered;
use Illuminate\Http\UploadedFile;

class MailConfermationTest extends TestCase
{
    use RefreshDatabase;

    public function test_sends_email_when_user_registers()
    {
        Mail::fake();
        Storage::fake('public');

        $response = $this->post('/register', [
        'fullname' => 'Maryam Abdullah',
        'username' => 'Maryam',
        'phone' => '01121651966',
        'whats' => '01121651966',
        'address' => 'Giza, Egypt',
        'password' => 'Pass@9876',
        'password_confirmation' => 'Pass@9876',
        'email' => 'Maryam@example.com',
        'imageUpload' => UploadedFile::fake()->image('avatar2.jpg'), 
    ]);
    
        Mail::assertSent(NewUserRegistered::class, function ($mail) {
            return $mail->hasTo('testtt3325@gmail.com') &&
                   $mail->user->username === 'Maryam' &&
                   $mail->envelope()->subject === 'New registered user' &&
                   str_contains($mail->render(), 'A new user Maryam is registered to the system.');
        });
    }
}