<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {
        $this->v['title'] = __('List room');
        $this->v['rooms'] = Room::paginate(config('custom.limit_page.room'));
        return view('admin.room.index',$this->v);
    }
    public function create()
    {
        $this->v['title'] = __('Add room');
        $this->v['categories'] = Category::where('status',config('custom.category_status.active'))->get();
        return view('admin.room.add', $this->v);
    }
    public function store(RoomRequest $request)
    {
        $model = new Room();
        $data = [];
        $data = $request->input();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->uploadFiles($request->file('image'));
        };
        $data['password'] = Hash::make($request->input('password'));
        $res = $model->create($data);
        if ($res) {
            Alert::success(__('messages.add.success'));
        } else {
            Alert::error(__('messages.add.failed'));
        }
        return redirect()->route('admin.room.index');
    }
    public function edit($id)
    {
        $this->v['title'] = __('Edit room');
        $this->v['categories'] = Category::where('status',config('custom.category_status.active'))->get();
        $this->v['room'] = Room::find($id);
        return view('admin.room.edit', $this->v);
    }
    public function update(RoomRequest $request, $id)
    {
        $model = Room::find($id);
        $data = [];
        $data = $request->input();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->uploadFiles($request->file('image'));
        };
        $data['password'] = Hash::make($request->input('password'));
        $res = $model->update($data);
        if ($res) {
            Alert::success(__('messages.update.success'));
        } else {
            Alert::error(__('messages.update.faild'));
        }
        return redirect()->route('admin.room.index');
    }
    public function destroy($id)
    {
        $model = Room::findOrFail($id);
        $booking = Booking::where('room_id',$id)->exists();
        if ($model!=null && $booking == false) {
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
    public function updateStatus($id)
    {
        $model = Room::findOrFail($id);
        $status = $model->status;
        $model->status = ($status == config('custom.room_status_text.active')) ? '0':'1';
        $model->save();
        $message = __('messages.update.success');
        $success = true;
        return response()->json([
            'success'=>$success,
            'message' => $message,
            'data' => __($model->status),
        ]);
    }
    public function uploadFiles($file)
    {
        $filename = time() . '-' . $file->getClientOriginalName();
        return $file->storeAs('img/room', $filename, 'public');
    }
}
