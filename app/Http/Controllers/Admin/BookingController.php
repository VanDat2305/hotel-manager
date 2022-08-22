<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {
        $this->v['title'] = __('List booking');
        $this->v['bookings'] = Booking::paginate(10);

        return view('admin.booking.index', $this->v);
    }
    public function create($room_id)
    {
        $this->v['room'] = Room::find($room_id);
        $this->v['title'] = __('BOOKING');
        // $this->v['dateBooked'] = $model->getAllDay($room_id);
        return view('admin.booking.add', $this->v);
    }
    public function store(BookingRequest $request,$room_id)
    {
        $model = new Booking();
        $checkDate = $model->getCheckBooked($room_id,$request);
        if (strtotime($request->input('checkin')) > strtotime($request->input('checkout'))) {
            Alert::error(__('messages.booking.faild'));
        }elseif ($checkDate) {
            Alert::error(__('messages.booking.already'));
        }else{
            if ($model->addBooking($request,$room_id)) {
                Alert::success(__('messages.booking.success'));
            }else{
                Alert::error(__('messages.booking.faild'));
            }
            return redirect()->route('admin.booking.index');
        }
        return redirect()->back()->withInput();
    }
    public function show($id)
    {
        $this->v['title'] = __('Booking Detail');
        $this->v['booking'] = Booking::find($id);
        return view('admin.booking.detail', $this->v);
    }
    public function destroy($id)
    {
        $model = Booking::findOrFail($id);
        if ($model!=null ) {
            $model->delete();
            $success = true;
            $message = __('messages.delete.success');
        } else {
            $success =  false;
            $message = __('messages.delete.faild');
        }
        return response()->json([
            'success'=> $success,
            'message' =>  $message
        ]);
    }
    public function listRoom()
    {
        $this->v['title'] = __('List room');
        $this->v['rooms'] = Room::paginate(config('custom.limit_page.room-booking'));
        return view('admin.booking.listRoom', $this->v);
    }
    public function updateStatus(Request $request,$id)
    {
        $model = Booking::findOrFail($id);
        $model->status = $request->status;
        $model->save();
        $message = __('messages.update.success');
        $success = true;
        return response()->json([
            'success'=>$success,
            'message' => $message,
            'data' => $model->status,
            'language' => __($model->status)
        ]);

    }
}
