<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.signin');
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            return redirect('/')->with('success', 'Xin chào ' . Auth::guard('customer')->user()->name);
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
    public function showAccount()
    {
        $user = Auth::guard('customer')->user();

        if ($user) {
            return view('pages.my-account', ['user' => $user]);
        } else {
            return redirect()->route('customer.login')->with('error', 'You must be logged in to view My Account.');
        }
    }
}
