<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(config('custom.limit_page.category'));
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => "required | unique:categories"
        ];
        $message = [
            'name.required' => __('messages.name.required'),
            'name.unique'=> __('messages.name.unique')
        ];
        $validator = Validator::make($request->input(),$rules,$message);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages(),
            ]);
        }else{
            $data['user_id'] = $request->input('user_id');
            $data['name'] = $request->input('name');
            $res = Category::create($data);
            return response()->json([
                'status' => true,
                'data' => $res,
                'message' => __('messages.add.success')
            ]);
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => "required | unique:categories,name,$id"
        ];
        $message = [
            'name.required' => __("messages.name.required"),
            'name.unique'=> __('messages.name.unique')
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
            $data['user_id'] = $request->input('user_id');
            $data['name'] = $request->input('name');
            $data['status'] = $request->input('status');
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
        //
    }
}
