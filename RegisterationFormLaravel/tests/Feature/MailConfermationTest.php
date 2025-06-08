<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Mail\NewUserRegistered;
use Illuminate\Http\UploadedFile;
use App\Models\RegisteredUsers;

class MailConfermationTest extends TestCase
{
    use RefreshDatabase;

    public function test_sends_email_when_user_registers()
    {
        Mail::fake();
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $userData = RegisteredUsers::factory()->make([
            'password' => 'ValidPass1!', 
            'password_confirmation' => 'ValidPass1!',
            'imageUpload' => $file,
        ])->toArray();
        $expectedUsername = $userData['username'];
        
        $response = $this->post('/register', $userData);
        
        Mail::assertSent(NewUserRegistered::class, function ($mail) use ($expectedUsername) {
            return $mail->hasTo('testtt3325@gmail.com') &&
                   $mail->user->username === $expectedUsername &&
                   $mail->envelope()->subject === 'New registered user' &&
                   str_contains($mail->render(), "A new user $expectedUsername is registered to the system.");
        });
    }
}