<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerForgotPasswordController extends Controller
{
    public function showCustomerLinkRequestForm()
    {
        return view('pages.customer.email');
    }
    public function sendPasswordResetLink(Request $request)
    {
        $data = $request->all();
        $customer = Customer::where('email', '=', $data['email_account'])->get();
        $title_mail = "Thay doi mat khau";
        foreach ($customer as $key => $value) {
            $id = $value->id;
        }
        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return redirect()->back()->with('error', 'Email chưa được đăng kí');
            } else {
                $token_random = Str::random();
                $customer = Customer::find($id);
                $customer->customer_token = $token_random;
                $customer->save();
                $to_mail = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email=' . $to_mail . '&token=' . $token_random);
                $data = array("name" => $title_mail, "body" => $link_reset_pass, "email" => $data['email_account']);

                Mail::send('pages.customer.forget_pass_notify', ['data' => $data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                return redirect()->back()->with('message', 'Gui email thanh cong');
            }
        }
    }
    public function update_new_pass()
    {
        return view('pages.customer.reset');
    }
    public function reset_new_pass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('email', '=', $data['email'])->where('customer_token', '=', $data['token'])->get();
        $count = $customer->count();
        if ($count > 0) {
            foreach ($customer as $key => $cus) {
                $id= $cus->id;
            }
            $reset = Customer::find($id);
            $reset->password =Hash::make($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('customer-login')->with('success', 'Successfully');
        } else {
            return redirect('customer-login')->with('error', 'Error');
        }
    }
}
