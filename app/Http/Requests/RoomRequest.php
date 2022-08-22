<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
                    'name' => 'required | unique:rooms',
                    'image' => 'required| image', 
                    'price' => 'required',
                    'description' => 'required'
                ];
                break;
            case 'update':
                $rules = [
                    'name' => 'required | unique:rooms,name,'.$id.',id',
                    'image' => ' image', 
                    'price' => 'required',
                    'description' => 'required'
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
    public function messages(){
        return [
            'name.required' => __('messages.name.required'),
            'name.unique' =>__('messages.name.unique'),
            'price.required' => __('messages.price.required'),
            'image.required' => __('messages.image.required'),
            'image.image' => __('messages.image.image'),
            'description.required'=> __('messages.description.required')
        ];
    }
}
