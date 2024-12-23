<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            // Check if the user is an admin
            if ($usertype == 'admin') {
                // Return the admin dashboard view
                return view('admin.index');
            } else {
                // Redirect regular users to their dashboard
                return redirect()->route('dashboard');
            }
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login');
    }
}
