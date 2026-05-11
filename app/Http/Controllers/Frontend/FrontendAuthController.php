<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;
use App\Services\BannerServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\ProductServiceInterface;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontendAuthController extends FrontendController
{
    public function __construct(
        BannerServiceInterface $bannerService,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService
    ) {
        parent::__construct($bannerService, $categoryService, $productService);
    }

    public function showLoginRegister()
    {
        return view('frontend.login-register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            // ✅ Guest cart ও wishlist data session regenerate এর আগে save করা হচ্ছে
            $guestCart = $request->session()->get('cart', []);
            $guestWishlist = $request->session()->get('wishlist', []);

            $request->session()->regenerate();

            // ✅ regenerate এর পর আবার cart ও wishlist restore করা হচ্ছে
            if (!empty($guestCart)) {
                $request->session()->put('cart', $guestCart);
            }
            if (!empty($guestWishlist)) {
                $request->session()->put('wishlist', $guestWishlist);
            }

            if ($request->filled('redirect')) {
                $redirect = $request->redirect;
                if ($redirect === 'cart' && $request->filled('product_id')) {
                    return redirect()->route('product.details', $request->product_id);
                } elseif ($redirect === 'wishlist' && $request->filled('product_id')) {
                    return redirect()->route('product.details', $request->product_id);
                }
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // ✅ Register এর আগে guest cart ও wishlist data save করা হচ্ছে
        $guestCart = $request->session()->get('cart', []);
        $guestWishlist = $request->session()->get('wishlist', []);

        try {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (QueryException $e) {
            return back()->withErrors(['email' => 'This email is already taken.'])->withInput();
        }

        Auth::login($user);

        // ✅ Login এর পর session regenerate হয়, তাই আবার cart ও wishlist restore করা হচ্ছে
        if (!empty($guestCart)) {
            $request->session()->put('cart', $guestCart);
        }
        if (!empty($guestWishlist)) {
            $request->session()->put('wishlist', $guestWishlist);
        }

        if ($request->filled('redirect')) {
            $redirect = $request->redirect;
            if ($redirect === 'cart' && $request->filled('product_id')) {
                return redirect()->route('product.details', $request->product_id);
            } elseif ($redirect === 'wishlist' && $request->filled('product_id')) {
                return redirect()->route('product.details', $request->product_id);
            }
        }

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function forgotpassword()
    {
        return view('frontend.forgot-passward');
    }


}
