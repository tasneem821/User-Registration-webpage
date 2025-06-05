<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredUsers extends Model
{
    /** @use HasFactory<\Database\Factories\RegisteredUsersFactory> */
    use HasFactory;

    protected $fillable = [
        'fullname',
        'username',
        'phone',
        'whats',
        'address',
        'password',
        'email',
        'imageUpload'
    ];
}