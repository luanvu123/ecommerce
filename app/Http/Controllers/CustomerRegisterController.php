<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8',
        ]);

        // Create a new customer
        $customer = new Customer();
        $customer->name = $validatedData['username'];
        $customer->email = $validatedData['email'];
        $customer->password = bcrypt($validatedData['password']);
        $customer->save();

        // Redirect the user after successful registration
        return redirect('/')->with('success', 'Registration successful!');
    }
    public function showRegistrationForm()
{
    return view('pages.signup');
}
}
