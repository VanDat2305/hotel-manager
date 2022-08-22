<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route()->id;
        $rules = [];
        switch ($this->route()->getActionMethod()) {
            case 'store':
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email | unique:users',
                    'phone' => 'required | min:10 ',
                    'password' => 'required | min:8',
                    're-password' => 'required | same:password',
                    'image' => 'image',
                ];
                break;
            case 'update':
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email | unique:users,email,' . $id . ',id',
                    'phone' => 'required | min:10 ',
                    'password' => '',
                    're-password' => ' same:password',
                    'image' => 'image',
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "Mời bạn điền tên",
            'email.required' => "Mời bạn nhập email",
            'email.email' => "Email không đúng định dạng",
            'email.unique' => "Email đã tồn tại",
            'phone.required' => "Mời bạn nhập số điện thoại",
            'phone.min' => "Số điện thoại không đúng",
            'password.required' => "Mời bạn nhập mật khẩu",
            'password.min' => "Mật khẩu không đủ 8 ký tự",
            're-password.required' => "Mời bạn nhập xác nhập mật khẩu",
            're-password.same' => "Mật khẩu không khớp",
            'image.image' => 'Ảnh không đúng định dạng '

        ];
    }
}