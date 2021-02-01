<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'pro_name' => 'required|unique:products,pro_name,'.$this->id,
            'pro_category_id' => 'required',
            'pro_producer' => 'required',
            'pro_price' => 'required',
            'pro_number' => 'required',
//            'pro_avatar' => 'required',
       //     'pro_description' => 'required',
            'pro_content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'pro_name.required' => 'Tên sản phẩm không được để trống',
            'pro_name.unique' => 'Tên sản phẩm đã tồn tại',
            'pro_category_id.required' => 'Chưa chọn danh mục sản phẩm',
            'pro_price.required' => 'Chưa nhập giá sản phẩm',
            'pro_number.required' => 'Chưa nhập số lượng sản phẩm',
       //     'pro_avatar.required' => 'Chưa chọn hình ảnh sản phẩm',
       //     'pro_description.required' => 'Chưa nhập mô tả ngắn',
            'pro_content.required' => 'Chưa nhập nội dung ',
            'pro_producer.required' => 'Chưa nhập tên nhà sản xuất '

        ];
    }

}
