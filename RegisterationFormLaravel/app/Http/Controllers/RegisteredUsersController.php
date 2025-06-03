<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredUsers;
use Illuminate\Support\Facades\Hash;

class RegisteredUsersController extends Controller
{
    public function store(Request $request)
        {
            $file = $request->file('imageUpload');
            $filename = null;

            if ($file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
            }

            RegisteredUsers::create([
                'fullname'         => $request->input('fullname'),
                'username'         => $request->input('username'),
                'phone'            => $request->input('phone'),
                'whats'            => $request->input('whats'),
                'address'          => $request->input('address'),
                'password'         => Hash::make($request->input('password')),
                'email'            => $request->input('email'),
                'imageUpload'      => $filename,
            ]);

            return back()->with('success', 'User registered successfully!');
        }
}
