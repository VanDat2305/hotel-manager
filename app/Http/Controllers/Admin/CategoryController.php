<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {
        $this->v['title'] = __('List category');
        $this->v['categories'] = Category::get();
        return view('admin.category.index', $this->v);
    }
    public function create()
    {
        $this->v['title'] = __('Add category');
        return view('admin.category.add', $this->v);
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => "required | unique:categories"
        ];
        $message = [
            'name.required' => Lang::get('messages.name.required'),
            'name.unique'=> Lang::get('messages.name.unique')
        ];
        $validator = Validator::make($request->input(),$rules,$message);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages(),
            ]);
        }else{
            $data['user_id'] = Auth::user()->id;
            $data['name'] = $request->input('name');
            $res = Category::create($data);
            return response()->json([
                'status' => true,
                'data' => $res,
                'message' => __('messages.add.success')
            ]);
        }
       
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => "required | unique:categories,name,$id"
        ];
        $message = [
            'name.required' => Lang::get("messages.name.required"),
            'name.unique'=> Lang::get('messages.name.unique')
        ];
        $validator = Validator::make($request->input(),$rules,$message);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages(),
            ]);
        }
        else{
            $model = Category::find($id);
            $data['user_id'] = Auth::user()->id;
            $data['name'] = $request->input('name');
            $res = $model->update($data);
            return response()->json([
                'status' => true,
                'data' => $res,
                'message' => __('messages.update.success')
            ]);
        }
    }
    public function destroy($id)
    {
        $model = Category::findOrFail($id);
        $room = Room::where('category_id',$id)->exists();
        if ($model!=null && $room == false) {
            $model->delete();
            $success = true;
            $message = __('messages.delete.success');
        } else {
            $success =  false;
            $message = __('messages.delete.failed');
        }
        return response()->json([
            'success'=> $success,
            'message' =>  $message
        ]);
    }
    public function updateStatus($id)
    {
        $model = Category::findOrFail($id);
        $status = $model->status;
        if ($status == config('custom.category_status_text.active')) {
            $model->status = '0';
        } else {
            $model->status = '1';
        }
        $model->save();
        $message = __('messages.update.success');
        $success = true;
        return response()->json([
            'success'=>$success,
            'message' => $message,
            'data' => __($model->status),
        ]);

    }
}
