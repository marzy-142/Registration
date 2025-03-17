<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in the user with the provided credentials
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication was successful, redirect the user
            return redirect()->intended('/');  // Redirect to the intended page or home page
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Handle logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
