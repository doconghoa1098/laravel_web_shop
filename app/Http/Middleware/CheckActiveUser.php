<?php


namespace App\Http\Middleware;
use Closure;

class CheckActiveUser
{
    public function handle($request, Closure $next)
    {
        if ( get_data_user('web','active') == 0)
        {
            \Toastr::warning('Tài khoản của bạn chưa active', 'Cảnh báo', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
        return $next($request);

    }
}
