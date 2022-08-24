<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;

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
        $this->v['title'] = __('HOME');
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
}
