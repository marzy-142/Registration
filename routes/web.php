<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');  // GET request to show the login form
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistrationController::class, 'register']);
