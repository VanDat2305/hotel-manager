<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
        $name = $this->route()->action['as'];
        $rules = [];
        switch ($name) {
            case 'admin.booking.store':
                $rules = [
                    'firstname' => "required",
                    'lastname' => 'required',
                    'email'=> 'required|email',
                    'phone' => 'required | numeric | min:11 ',
                    'checkin' => 'required',
                    'checkout' => 'required | different:checkin',
                    'address' => 'required'
                ];
                break;
            
            default:
                break;
        }
        return $rules;
    }
    public function messages(){
        return [
            'firstname.required' => __('messages.firstname.required'),
            'lastname.required' => __('messages.lastname.required'),
            'email.required' => __('messages.email.required'),
            'email.email'=> __('messages.email.email'),
            'phone.required' => __('messages.phone.required'),
            'phone.min' => __('messages.phone.min'),
            'phone.numeric'=> __('messages.phone.numeric'),
            'checkin.required' => __('messages.checkin.required'),
            'checkout.required' => __('messages.checkout.required'),
            'checkout.different' => __('messages.checkout.different'),
            'address.required' => __('messages.address.required')
        ]; 
    }
}
