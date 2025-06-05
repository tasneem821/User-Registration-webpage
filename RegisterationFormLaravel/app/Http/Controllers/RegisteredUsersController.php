<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredUsers;
use Illuminate\Support\Facades\Hash;

class RegisteredUsersController extends Controller
{
    public function store(Request $request)
    {
        // 1. VALIDATION
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:registered_users',
            'phone' => 'required|string|max:20',
            'whats' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
   'password' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/'
    ],            'email' => 'required|email|max:255|unique:registered_users',
            'imageUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. FILE UPLOAD HANDLING
        $filename = null;
        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
        }

        // 3. CREATE USER
        RegisteredUsers::create([
            'fullname' => $validated['fullname'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
            'whats' => $validated['whats'] ?? null,
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'imageUpload' => $filename,
        ]);

        // 4. REDIRECT WITH SUCCESS
        return back()->with('success', 'User registered successfully!');
    }
}