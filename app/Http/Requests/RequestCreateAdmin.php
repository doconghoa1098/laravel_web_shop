<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateAdmin extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->id,
            'phone' => 'required|unique:users,phone|regex:/(0)/|size:10'.$this->id,
            'password' => 'required',
            'address' => 'required',
            'roles' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên thành viên không được để trống',
            'email.required' => 'Chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Chưa nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.regex' => 'Số điện thoại bắt đầu bằng 0',
            'phone.size' => 'Số điện thoại phải ít nhất 10 số',
            'password.required' => 'Chưa nhập mật khẩu',
            'address.required' => 'Chưa nhập địa chỉ ',
            'roles.required' => 'Chưa chọn chức vụ',
        ];
    }
}
