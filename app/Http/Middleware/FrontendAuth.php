<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FrontendAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            session()->flash('login_message', 'Please login to add to cart, wishlist or place order.');
            return redirect()->route('user.login');
        }

        return $next($request);
    }
}