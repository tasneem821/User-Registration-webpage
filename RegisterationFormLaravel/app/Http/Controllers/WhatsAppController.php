<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function checkWhatsAppNumber(Request $request)
{
    if (!$request->wantsJson()) {
        abort(403, 'This route only accepts JSON requests');
    }

    try {
        $validated = $request->validate([
            'whats' => 'required|string|regex:/^01[0125][0-9]{8}$/'
        ]);

        $phone = '2' . $validated['whats']; 

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => config('services.rapidapi.key'),
            'X-RapidAPI-Host' => config('services.rapidapi.whatsapp_host'),
        ])->withOptions(['http_errors' => false])
        ->post('https://' . config('services.rapidapi.whatsapp_host') . '/WhatsappNumberHasItWithToken', [
            'phone_number' => $phone
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['status']) && $data['status'] === 'valid') {
                return response()->json(['valid' => true]);
            } else {
                return response()->json([
                    'valid' => false,
                    'message' => $data['message'] ?? 'Invalid WhatsApp number.'
                ], 422);
            }
        } else {
            Log::error('WhatsApp API failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return response()->json(['message' => 'WhatsApp validation service unavailable'], 503);
        }
    } catch (\Exception $e) {
        Log::error('WhatsApp validation error: ' . $e->getMessage());
        return response()->json(['message' => 'WhatsApp validation service unavailable'], 503);
    }
}
}