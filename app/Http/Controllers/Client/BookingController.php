<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function formCheckout(BookingRequest $request ,$room_id){
        $model = new Booking();
        $checkDate = $model->getCheckBooked($room_id,$request);
        if (strtotime($request->input('checkin')) > strtotime($request->input('checkout'))) {
            Alert::error(__('messages.booking.faild'));
        }elseif ($checkDate) {
            Alert::error(__('messages.booking.already'));
        }else{
            if (auth('customer')->check()) {
                $this->v['room'] = Room::find($room_id);
                $this->v['checkin'] = $request->checkin;
                $this->v['checkout'] = $request->checkout;
                $this->v['sub_price'] =Booking::calcPrice($request->checkin, $request->checkout, $room_id);
                $this->v['vat'] =$this->v['sub_price']*config('custom.vat')/100;
                $this->v['totalPrice'] =   $this->v['sub_price']+$this->v['vat'];
                return view('client.formCheckout',$this->v);
            }else{
                Alert::info(__('Required Login'));
                return redirect()->route('login');
            }
        }
        return redirect()->back()->withInput();
    }
}
