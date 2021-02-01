<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPay extends FormRequest
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
            'p_name' => 'required|unique:pays,p_name, '.$this->id,
            'p_content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'p_name.required' => 'Tên bài viết không được để trống',
            'p_name.unique' => 'Tên bài viết đã tồn tại',
            'p_content.required' => 'Chưa nhập nội dung'

        ];
    }
}
