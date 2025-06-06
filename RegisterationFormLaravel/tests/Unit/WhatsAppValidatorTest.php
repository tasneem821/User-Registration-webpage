<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Http\Request;

class WhatsAppValidatorTest extends TestCase
{
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new WhatsAppController();
        Log::spy();
    }

    /** @test */
    public function test_returns_valid_response_for_valid_whatsapp_numbers()
    {
        Http::fake([
            '*' => Http::response([
                'status' => 'valid',
                'message' => 'Number is valid on WhatsApp'
            ], 200)
        ]);
    
        $request = Request::create('/check-whatsapp', 'POST', [
            'whats' => '01234567890'
        ]);
        $request->headers->set('Accept', 'application/json');
    
        $response = $this->controller->checkWhatsAppNumber($request);
    
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals(['valid' => true], json_decode($response->getContent(), true));
    }
    

    /** @test */
    public function test_returns_invalid_response_for_invalid_whatsapp_number()
    {
        Http::fake([
            '*' => Http::response([
                'status' => 'invalid',
                'message' => 'invalid whatsapp number'
            ], 200)
        ]);
    
        $request = Request::create('/check-whatsapp', 'POST', [
            'whats' => '01234567890'
        ]);
        $request->headers->set('Accept', 'application/json');
    
        $response = $this->controller->checkWhatsAppNumber($request);
    
        $this->assertEquals(422, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals([
            'valid' => false,
            'message' => 'invalid whatsapp number'
        ], json_decode($response->getContent(), true));
    }
    

    /** @test */
    public function test_returns_403_if_request_is_not_json()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

        $request = Request::create('/check-whatsapp', 'POST', [
            'whats' => '01234567890'
        ]);

        $this->controller->checkWhatsAppNumber($request);
    }

    /** @test */
    public function test_returns_503_if_api_fails()
{
    Http::fake([
        '*' => Http::response('Internal Server Error', 500)
    ]);

    $request = Request::create('/check-whatsapp', 'POST', [
        'whats' => '01234567890'
    ]);
    $request->headers->set('Accept', 'application/json');

    $response = $this->controller->checkWhatsAppNumber($request);

    $this->assertEquals(503, $response->getStatusCode());
    $this->assertJson($response->getContent());
    $this->assertEquals(
        ['message' => 'WhatsApp validation service unavailable'],
        json_decode($response->getContent(), true)
    );
}

}
