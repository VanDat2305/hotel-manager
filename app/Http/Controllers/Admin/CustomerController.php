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
    public function destroy($id)
    {
        $model = Customer::findOrFail($id);
        if ($model != null) {
            $model->delete();
            $success = true;
            $message = __('messages.delete.success');
        } else {
            $success =  false;
            $message = __('messages.delete.faild');
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
        $message = __('messages.update.success');
        $success = true;
        return response()->json([
            'success'=>$success,
            'message' => $message,
            'data' => __($model->status),
        ]);

    }
}
