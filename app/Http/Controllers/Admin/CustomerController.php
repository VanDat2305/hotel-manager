<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index()
    {
        $this->v['title'] = 'List customer';
        $this->v['customers'] = Customer::paginate(config('custom.limit_page.customer'));
        return view('admin.customer.index', $this->v);
    }
    public function create()
    {
        $this->v['title'] = 'List customer';
    }
    public function store(Request $request)
    {
        //
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
        //
    }
    public function destroy($id)
    {
        $model = Customer::findOrFail($id);
        if ($model != null) {
            $model->delete();
            $success = true;
            $message = "Xóa thành công";
        } else {
            $success =  false;
            $message = "Xóa thất bại";
        }
        return response()->json([
            'status' => true,
            'success' => $success,
            'message' =>  $message
        ]);
    }
    public function updateStatus($id)
    {
        $model = Customer::findOrFail($id);
        $status = $model->status;
        if ($status == config('custom.customer_status_text.active')) {
            $model->status = '0';
        } else {
            $model->status = '1';
        }
        $model->save();
        $message = 'Update thành công';
        $success = true;
        return response()->json([
            'success'=>$success,
            'message' => $message,
            'data' => $model->status,
        ]);

    }
}
