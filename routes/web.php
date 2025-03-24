<?php

use App\Models\User;
use Illuminate\Http\Request;  // FIXED: Import Request
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/magic-login', function (Request $request) {
    $userId = $request->query('user');  // explicitly get the query parameter

    $user = User::find($userId);  // this now returns a User model or null

    if (!$user) {
        abort(404, 'User not found.');
    }

    $expectedSignature = sha1($user->email . config('app.key'));

    if (!hash_equals($expectedSignature, $request->query('signature'))) {
        abort(403, 'Invalid or expired login link.');
    }

    Auth::login($user);  // FIXED: Now it's a User model, not a Collection

    return redirect('/dashboard');
})->name('auth.magic.login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);
