<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RequestRegister;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\FrontendController;


class RegisterController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RequestRegister $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->save();

        if ($user->id)
        {
            \Toastr::success('Đăng ký thành công thành công ! Hãy đăng nhập để mua hàng', 'Thành công', ["positionClass" => "toast-top-center"]);
            return redirect()->route('get.login');
        }
        return redirect()->back();

    }
}
