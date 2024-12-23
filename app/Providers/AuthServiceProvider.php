<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // No need to call parent::boot() as it does not exist

        // Listen to the 'Authenticated' event
        Event::listen(Authenticated::class, function ($event) {
            $user = $event->user;

            // Redirect based on the usertype
            if ($user->usertype == 'admin') {
                // Redirect admin to the admin dashboard
                return Redirect::route('admin.index');
            } else {
                // Redirect regular user to the dashboard
                return Redirect::route('dashboard');
            }
        });
    }
}
