<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Boolean;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    protected $v;
    public function __construct()
    {
        $this->v = [];
    }
  
    public function index()
    {
        $this->v['title'] = 'List user';
        $this->v['users'] = User::paginate(config('custom.limit_page.user'));
        return view('admin.user.index', $this->v);
    }

    public function create()
    {
        $this->v['title'] = 'Add user';
        return view('admin.user.add', $this->v);
    }

    public function store(UserRequest $request)
    {
        $model = new User();
        $data = [];
        $data = $request->input();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->uploadFiles($request->file('image'));
        };
        $res = $model->create($data);
        if ($res) {
            Alert::success('Thêm mới thành công');
        } else {
            Alert::error('Thêm mới thất bại');
        }
        return redirect()->route('admin.user.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->v['title'] = 'Edit user';
        $this->v['user'] = User::find($id);
        return view('admin.user.edit', $this->v);
    }

  
    public function update(UserRequest $request, $id)
    {

        $model = User::find($id);
        $data = [];
        $data = $request->input();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->uploadFiles($request->file('image'));
        };
        $data['password'] = Hash::make($request->input('password'));
        if ($request->input('status') == null) {
            $data['status'] = '0';
        }
        if ($request->input('role_id') == null) {
            $data['role_id'] = '2';
        }else{
            $data['role_id'] = '1';
        }
        $model->update_role($id,$data['role_id']);
        $res = $model->update($data);
        if ($res) {
            Alert::success('Sửa thành công');
        } else {
            Alert::error('Sửa thất bại');
        }
        return redirect()->route('admin.user.index');
    }

   
    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $cate = Category::where('user_id',$id)->exist();
        if ($model!=null && $cate == false) {
            $model->delete();
            $success = true;
            $message = "Xóa thành công";
        } else {
            $success =  false;
            $message = "Xóa thất bại";
        }
        return response()->json([
            'success'=> $success,
            'message' =>  $message
        ]);
    }
    public function updateStatus($id)
    {
        $model = User::findOrFail($id);
        $status = $model->status;
        $model->status = $status == config('custom.user_status_text.active') ? '0' : '1';
        $model->save();
        $message = 'Update thành công';
        $success = true;
        return response()->json([
            'success'=>$success,
            'message' => $message,
            'data' => $model->status,
        ]);

    }
    public function uploadFiles($file)
    {
        $filename = time() . '-' . $file->getClientOriginalName();
        return $file->storeAs('img/user', $filename, 'public');
    }
}