<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function getFormRegister()
    {
        $this->v['title'] = 'SignUp';
        return view('client.auth.register', $this->v);
    }
    public function postRegister(CustomerRequest $request)
    {
        
        if (Customer::insertCustomer($request->all())) {
            $time = time() + 15;
            Cookie::queue('email', $request->email, $time);
            Cookie::queue('password', $request->password, $time);
            Alert::success(__('Add success'));
            return redirect()->route('login');
        }else{
            Alert::error(__('Add faild'));
            return redirect()->route('register');
        }
    }
}
