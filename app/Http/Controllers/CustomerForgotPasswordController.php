<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class CustomerForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
}
