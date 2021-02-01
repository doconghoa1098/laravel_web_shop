<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\RequestLogin;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(RequestLogin $request)
    {

        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            \Toastr::success('Đăng nhập thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
            return redirect()->route('home');
        }
        return redirect()->back()->with('danger','Email hoặc mật khẩu sai');


    }

    public function getLogout()
    {
        \Auth::logout();
        return redirect()->route('home');
    }

}
