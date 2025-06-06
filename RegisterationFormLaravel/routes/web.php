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

Route::post('/register', [RegisteredUsersController::class, 'store'])->name('register.store');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::post('/check-whatsapp', [WhatsAppController::class, 'checkWhatsAppNumber'])->name('check.whatsapp');
