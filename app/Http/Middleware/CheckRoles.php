<?php


namespace App\Http\Middleware;
use Closure;

class CheckRoles
{
    public function handle($request, Closure $next)
    {
        if (get_data_user('admins','roles') != 1)
        {
            \Toastr::warning('Không có quyền truy cập', 'Cảnh báo', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.home');
        }
        return $next($request);

    }
}
