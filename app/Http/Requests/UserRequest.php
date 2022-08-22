<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

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
            'name.required' => Lang::get('messages.name.required'),
            'email.required' => Lang::get('messages.email.required'),
            'email.email' => Lang::get('messages.email.email'),
            'email.unique' => Lang::get('messages.email.required'),
            'phone.required' => Lang::get('messages.phone.required'),
            'phone.min' => Lang::get('messages.phone.min'),
            'password.required' => Lang::get('messages.password.required'),
            'password.min' => Lang::get('messages.password.min'),
            're-password.required' => Lang::get('messages.re-password.required'),
            're-password.same' => Lang::get('messages.re-password.same'),
            'image.image' => Lang::get('messages.image.image')

        ];
    }
}