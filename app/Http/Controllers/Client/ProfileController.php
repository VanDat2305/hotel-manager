<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index(){
        $id = auth('customer')->user()->id;
        $this->v['bookings'] = Booking::where('customer_id',$id)->paginate(config('custom.limit_page.room-client'));
        return view('client.dashboard',$this->v);
    }
}
