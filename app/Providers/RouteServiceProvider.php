<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by the authentication controllers to redirect users
     * after they log in. You can change this to whatever path you want.
     *
     * @var string
     */
    public const HOME = '/dashboard';  // Default for regular users

    /**
     * Define your route model bindings, pattern filters, and other route services.
     *
     * @return void
     */
    public function boot()
    {

        // Custom redirection after login based on usertype
        Route::middleware('web')->group(function () {
            if (Auth::check()) {
                $user = Auth::user();

                // Redirect the user based on their role after login
                if ($user->usertype == 'admin') {
                    return redirect()->route('admin.dashboard');  // Admin route
                } else {
                    return redirect()->route('dashboard');  // Regular user route
                }
            }
        });
    }
}
