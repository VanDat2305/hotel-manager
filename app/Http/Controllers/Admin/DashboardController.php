<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index(){
        $this->v['title'] = 'Dashboard';
        $this->v['countCate'] = Category::active()->get()->count() ;
        $this->v['countRoom'] = Room::active()->get()->count() ;
        $this->v['countCustomer'] = Customer::active()->get()->count() ;
        $this->v['countBooking'] = Booking::complete()->get()->count() ;
        return view('admin.dashboard',$this->v);
    }
}
