<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use App\Models\Customer;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function getFormLogin()
    {
        $this->v['title'] = 'SignIn';

        if (auth('customer')->check()) {
            Alert::success(__('Account is logged in'));
            return redirect()->route('home');
        }
        // dd(Cookie::get('email'));
        if (Cookie::get('email')) {
            $this->v['email'] = Cookie::get('email');
            $this->v['password'] = Cookie::get('password');
        }
        return view('client.auth.login', $this->v);
    }
    public function postLogin(LoginAdminRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = ($request->has('remember'));
        if (auth('customer')->attempt(['email' => $email, 'password' => $password, 'status' => '1'])) {
            if ($remember) {
                $time = time() + 60 * 60 * 24 * 7;
                Cookie::queue('email', $email, $time);
                Cookie::queue('password', $password, $time);
            } else {
                Cookie::queue(
                    Cookie::forget('email')
                );
                Cookie::queue(
                    Cookie::forget('password')
                );
            }
            Alert::success(__('Sign In success'));
            return redirect()->route('home');
        } elseif (Customer::where('email', $email)->where('status',0)->first()) {
            Alert::error(__('Account not active'));
            return redirect()->route('login')->withInput();
        } else {
            Alert::error(__('Email or password not true'));
            return redirect()->route('login')->withInput();
        }
    }
    public function logout()
    {
        auth('customer')->logout();
        return redirect()->route('home');
    }
}
