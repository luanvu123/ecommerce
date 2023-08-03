<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $customer = Customer::where('email', $user->getEmail())->first();

            if (!$customer) {
                $customer = new Customer();
                $customer->name = $user->getName();
                $customer->email = $user->getEmail();
                $customer->password = Hash::make('');
                $customer->save();
            }
            Auth::guard('customer')->login($customer);
            return redirect('/')->with('success', 'Xin chào ' . $customer->name);
        } catch (\Exception $e) {
            return redirect()->route('customer.login')->with('error', 'Failed to log in with Google.');
        }
    }
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $customer = Customer::where('facebook_id', $user->getId())->first();

            if (!$customer) {
                // Check if the user's Facebook account email is already registered in your application
                $existingCustomer = Customer::where('email', $user->getEmail())->first();
                if ($existingCustomer) {
                    // If the email is already registered, associate the Facebook account with the existing customer
                    $existingCustomer->facebook_id = $user->getId();
                    $existingCustomer->save();
                    Auth::guard('customer')->login($existingCustomer);
                    return redirect('/')->with('success', 'Xin chào ' . $existingCustomer->name);
                }

                // If the email is not registered, create a new customer
                $customer = new Customer();
                $customer->name = $user->getName();
                $customer->email = $user->getEmail();
                $customer->password = Hash::make(''); // You can leave the password empty or generate a random password
                $customer->facebook_id = $user->getId();
                $customer->save();
            }

            Auth::guard('customer')->login($customer);
            return redirect('/')->with('success', 'Xin chào ' . $customer->name);
        } catch (\Exception $e) {
            return redirect()->route('customer.login')->with('error', 'Failed to log in with Facebook. Please try again.');
        }
    }
}
