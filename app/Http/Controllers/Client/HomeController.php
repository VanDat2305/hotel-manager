<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function home(){
        $this->v['title'] = __('HOME');
        $this->v['rooms'] = Room::inRandomOrder()->get();
        $this->v['categories'] = Category::active()->get();
        return view('client.home',$this->v);
    }
    public function room(){
        $this->v['title'] = __('ROOM');
        $this->v['rooms'] = Room::paginate(config('custom.limit_page.room'));
        $this->v['categories'] = Category::active()->get();
        $this->v['cate_id'] = 0;
        return view('client.room',$this->v);
    }
    public function roomDetail($id){
        $this->v['room'] =  Room::find($id);
        $this->v['roomSameCate'] = Room::where('id','!=',$id )->where('category_id',$this->v['room']->category_id)->first() ;
        return view('client.room-detail',$this->v);
    }
    public function getDate($id){
        $model = new Booking();
        $dateArray =$model->getDateAll($id);
        return response()->json([
           "success" => true,
            "data" => $dateArray
        ]);
    }
    public function getRoomByCate($category_id){
        $this->v['rooms'] = Room::where('category_id',$category_id)->active()->paginate(config('custom.limit_page.room'));
        $this->v['categories'] = Category::active()->get();
        $this->v['cate_id'] = $category_id;
        return view('client.room',$this->v);
    }
    public function searchDate(BookingRequest $request){
        $this->v['checkin'] = $request->checkin;
        $this->v['checkout'] = $request->checkout;
        $this->v['cate_id'] = $request->category_id;
        $this->v['rooms'] = Room::searchByDate($request);
        $this->v['categories'] = Category::active()->get();
        return view('client.room',$this->v);
    }
}
