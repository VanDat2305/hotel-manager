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
            'firstname.required' => 'Mời bạn nhập firstname',
            'lastname.required' => 'Mời bạn nhập lastname',
            'email.required' => 'Mời bạn nhập email',
            'email.email'=> 'Email không đúng định dạng',
            'phone.required' => 'Mời bạn nhập số điện thoại',
            'phone.min' => 'Số điện thoại không đủ 11 số',
            'phone.numeric'=> 'Mời nhập đúng định dạng',
            'checkin.required' => 'Mời chọn ngày checkin',
            'checkout.required' => 'Mời chọn ngày checkout',
            'checkout.different' => 'Ngày checkout trung ngày checkin',
            'address.required' => 'Mời nhập địa chỉ'
        ]; 
    }
}
