<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPassword extends FormRequest
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
            'password_old' => 'required',
            'password_new' => 'required',
            'password_confim' => 'required|same:password_new',
        ];
    }

    public function messages()
    {
        return [
            'password_old.required' => 'Chưa nhập mật khẩu cũ',
            'password_new.required' => 'Chưa nhập mật khẩu mới',
            'password_confim.required' => 'Chưa xác nhận mật khẩu',
            'password_confim.same' => 'Mật khẩu xác nhận sai',
        ];
    }
}
