<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.signin');
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            // Đăng nhập thành công
           return redirect('/')->with('success', 'Xin chào ' . Auth::guard('customer')->user()->name);

        } else {
            // Đăng nhập thất bại
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
        }
    }


    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
