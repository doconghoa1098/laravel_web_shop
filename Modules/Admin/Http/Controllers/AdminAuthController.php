<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestLogin;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin::auth.login');
    }

    public function postLogin(RequestLogin $request)
    {
        $data = $request->only('email','password');
        if (Auth::guard('admins')->attempt($data)) {
            \Toastr::success('Đăng nhập thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.home');
        }
        return redirect()->back()->with('danger','Email hoặc mật khẩu sai');

    }
    public function LogoutAdmin()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('home');
    }

}
