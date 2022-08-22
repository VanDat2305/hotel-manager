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
                dd($id);
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
            'name.required' => 'Vui lòng điền tên',
            'name.unique' => 'Tên đã tồn tại',
            'price.required' => 'Vui lòng điền giá',
            'image.required' => 'Vui lòng chọn ảnh',
            'image.image' => 'Ảnh không đúng định dạng',
            'description.required'=> 'Vui lòng điền mô tả'
        ];
    }
}
