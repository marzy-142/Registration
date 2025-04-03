<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\PasswordResetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/magic-login', function (Request $request) {
    $userId = $request->query('user');

    $user = User::find($userId);

    if (!$user) {
        abort(404, 'User not found.');
    }

    $expectedSignature = sha1($user->email . config('app.key'));

    if (!hash_equals($expectedSignature, $request->query('signature'))) {
        abort(403, 'Invalid or expired login link.');
    }

    if ($user instanceof \Illuminate\Database\Eloquent\Collection) {
        dd('Error: $user is a collection!', $user);
    }

    Auth::login($user);

    return redirect('/dashboard');
})->name('auth.magic.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Forgot Password Routes
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendPasswordResetLink'])->name('password.email');

// Reset Password Routes
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// Registration Routes
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);
