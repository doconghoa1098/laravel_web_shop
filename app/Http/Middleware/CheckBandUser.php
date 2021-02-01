<?php


namespace App\Http\Middleware;
use Closure;

class CheckBandUser
{
    public function handle($request, Closure $next)
    {
        if ( get_data_user('web','active') == 4)
        {
            \Toastr::warning('Tài khoản của bạn bị khóa', 'Cảnh báo', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
        return $next($request);

    }
}
