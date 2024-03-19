<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customer::where('username', $request->username)->first();
        if ($customer)
        {
            flash()->error('Registration Error','Your username already exit!');
            return redirect()->back();
        }
        else
        {
            $this->validate($request,[
                'username'=>'required|unique:customers',
                'password'=>'required'
            ]);

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->username = $request->username;
            $customer->email = $request->email;
            $customer->mobile = $request->mobile;
            $customer->password = bcrypt($request->password);
            $customer->save();

            Session::put('username', $request->username);
            Session::put('user_id', $customer->id);

            flash()->success('Registration Successfull','You have been logged in.');
            return redirect()->back();
        }

    }

    public function login_check(Request $request)
    {
        $customer = Customer::where('username', $request->username)->first();

        if ($customer)
        {
            if (password_verify($request->password, $customer->password))
            {
                Session::put('user_id', $customer->id);
                Session::put('username', $customer->username);

                flash()->success('Registration Successfull','You have been logged in.');
                return redirect()->route('home');
            }
            else
            {
                flash()->error('Login error','Incorrect username or password');
                return redirect()->back();
            }
        }
        else
        {
            flash()->error('Login error','Incorrect username or password');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Session::forget('user_id');
        Session::forget('username');

        flash()->success('Logout successfull','You have been logged out.');
        return redirect('/');
    }
}
