<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => __('messages.email.required'),
            'email.email' => __('messages.email.email'),
            'password.required' => __('messages.password.required'),
            'password.min' => __('messages.password.min'),
        ];
    }
}
