<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LoginAdminController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function getFormLogin()
    {
        if (Auth::check()) {
            Alert::success('Tài khoản đang đăng nhập');
            return redirect()->route('admin.');
        }
        return view('admin.login');
    }
    public function postLogin(LoginAdminRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            Alert::success('Đăng nhập thành công với tài khoản '.Auth::user()->role->name );
            return redirect('/admin');
        } else {
            Session::flash('error', 'Email hoặc password không đúng');
            return redirect()->route('formLoginAdmin')->withInput();
        }
    }
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('formLoginAdmin');
    }
}