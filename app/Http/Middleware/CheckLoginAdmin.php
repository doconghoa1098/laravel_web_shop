<?php


namespace App\Http\Middleware;
use Closure;

class CheckLoginAdmin
{
    public function handle($request, Closure $next)
    {
        if (!get_data_user('admins') || get_data_user('admins','active') != 2)
        {
            return redirect()->route('admin.login')->with('danger','Email hoặc mật khẩu sai');
        }
        return $next($request);


    }
}
