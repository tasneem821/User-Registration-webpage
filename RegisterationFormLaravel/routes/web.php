<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisteredUsersController;
use App\HTTP\Controllers\WhatsAppController;


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/check-username', [RegisteredUsersController::class, 'checkUsername'])->name('check.username');
Route::get('ar',function(){
    session()->put('locale','ar');
    return redirect()->back();
})->name('ar');

Route::get('en',function(){
    session()->put('locale','en');
    return redirect()->back();
})->name('en');

Route::post('/store_register', [RegisteredUsersController::class, 'store'])->name('register.store');
Route::post('/register', [RegisteredUsersController::class, 'index'])->name('register.index');
Route::post('/check-whatsapp', [WhatsAppController::class, 'checkWhatsAppNumber'])->name('check.whatsapp');
