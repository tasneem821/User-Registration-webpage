<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisteredUsersController;




Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisteredUsersController::class, 'store'])->name('register.store');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');
