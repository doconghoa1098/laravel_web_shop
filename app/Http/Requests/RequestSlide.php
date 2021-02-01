<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSlide extends FormRequest
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

    public function rules()
    {
        return [
            's_avatar' => 'required',
//            's_product_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            's_avatar.required' => 'Chưa chọn slide',
//            's_product_id.required' => 'Chưa chọn sản phẩm được gắn với slide'

        ];
    }
}
