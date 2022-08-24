<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                $rules = [
                    'firstname' => "required",
                    'lastname' => 'required',
                    'email'=> 'required|email|unique:customers,email',
                    'phone' => 'required | numeric | min:11 ',
                    'address' => 'required',
                    'password' => 'required | min:8',
                    're-password' => 'required | same:password',
                ];
        return $rules;
    }
    public function messages(){
        return [
            'firstname.required' => __('messages.firstname.required'),
            'lastname.required' => __('messages.lastname.required'),
            'email.required' => __('messages.email.required'),
            'email.email'=> __('messages.email.email'),
            'email.unique'=> __('messages.email.unique'),
            'phone.required' => __('messages.phone.required'),
            'phone.min' => __('messages.phone.min'),
            'phone.numeric'=> __('messages.phone.numeric'),
            'password.required' => __('messages.password.required'),
            'password.min' => __('messages.password.min'),
            're-password.required' => __('messages.re-password.required'),
            're-password.same' => __('messages.re-password.same'),
            'address.required' => __('messages.address.required')
        ]; 
    }
}
