<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\RequestResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Mail;

class ForgotPasswordController extends FrontendController
{

    use SendsPasswordResetEmails;

//    public function __construct()
//    {
//        $this->middleware('guest');
//    }
    public function getResetPassword()
    {
        return view('auth.passwords.email');
    }
    public function sentCodeResetPassword(Request $request)
    {
        $email = $request->email;
        $checkUser = User::where('email',$email)->first();
        if ( !$checkUser)
        {
            \Toastr::warning('Email không tồn tại', '', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }

        $code = bcrypt(md5(time().$email));
        $checkUser->code = $code;
        $checkUser->time_code= Carbon::now();
        $checkUser->save();

        $url = route('get.link.reset.password',['code' => $checkUser->code,'email' => $email ]);

        $data = [
            'url' => $url
        ];
        Mail::send('email.reset_password', $data, function($message) use ($email){
            $message->to($email, 'Reset Password')->subject('Reset Password');
        });
        \Toastr::success('Link lấy lại mật khẩu đã gửi đến email của bạn.Hãy kiểm tra', '', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }

    public function resetPassword(Request $request)
    {
        $code = $request->code;
        $email = $request->email;

        $checkUser = User::where('email',$email)->first();
        $time_code = $checkUser->time_code;
        $time = Carbon::now()->subMinute(5);  //+thêm 5 phút từ lúc gửi.nếu tg kích vào link sau 5 phút đó thì hết hạn
        if ( $time > $time_code)
        {
            $checkUser->code = null;
            $checkUser->save();
        }
        $checkUser2 = $checkUser->where('code',$code)->first();

        if (!$checkUser2)
        {
            \Toastr::warning('Không tồn tại.Hãy kiểm tra lại đường link của bạn', '', ["positionClass" => "toast-top-center"]);
            return redirect('/');
        }

        return view('auth.passwords.reset',compact('email'));
    }

    public function saveresetPassword(RequestResetPassword $requestResetPassword)
    {
        $code = $requestResetPassword->code;
        $email = $requestResetPassword->email;

        $checkUser = User::where('email',$email)->first();
        $time_code = $checkUser->time_code;
        $time = Carbon::now()->subMinute(5);   ///tg hiện tại trừ đi 5 phút nếu lớn hơn tg lúc tạo code trc đó thì đưa code về null
        if ( $time > $time_code)
        {
            $checkUser->code = null;
            $checkUser->time_code = null;
            $checkUser->save();
        }
        $checkUser2 = $checkUser->where('code',$code)->first();

        if (!$checkUser2)
        {
            \Toastr::warning('Không tồn tại.Hãy kiểm tra lại đường link của bạn', '', ["positionClass" => "toast-top-center"]);
            return redirect('/');
        }
        $checkUser2->password = bcrypt($requestResetPassword->password_new);
        $checkUser2->code = null;
        $checkUser2->time_code = null;
        $checkUser2->save();
        \Toastr::success('Đổi mật khẩu thành công', '', ["positionClass" => "toast-top-center"]);
        return redirect()->route('home');
    }



    public function getActiveAccount()
    {
        $email = get_data_user('web','email');
        $user =  User::where('email',$email)->first();
        $code = bcrypt(md5(time().$email));
        $user->code = $code;
        $user->time_code= Carbon::now();
        $user->save();

        $url = route('get.link.active.account',['code' => $user->code,'email' => $email ]);

         $data = [
             'url' => $url
         ];
         Mail::send('email.active_account', $data, function($message) use ($email){
             $message->to($email, 'ACTIVE ACCOUNT')->subject('Kích hoạt tài khoản');
         });
        \Toastr::success('Link kích hoạt tài khoản đã gửi đến email của bạn.Hãy kiểm tra và kích hoạt', '', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }

    public function activeAccount(Request $request)
     {
         $code = $request->code;
         $email = $request->email;

         $user = User::where('email',$email)->first();
         $time_code = $user->time_code;
         $time = Carbon::now()->subMinute(5);   // +thêm 5 phút từ lúc gửi.nếu tg kích vào link sau 5 phút đó thì link hết hạn
         if ( $time > $time_code)
         {
             $user->code = null;
             $user->time_code = null;
             $user->save();
         }
         $user2 = $user->where('code',$code)->first();

         if (!$user2)
         {
             \Toastr::warning('Không tồn tại.Hãy kiểm tra lại đường link của bạn', '', ["positionClass" => "toast-top-center"]);
             return redirect('/');
         }
         $user2->active = 1;
         $user2->code = null;
         $user2->time_code = null;
         $user2->save();
         \Toastr::success('Tài khoản của bạn đã được active thành công', '', ["positionClass" => "toast-top-center"]);
         return redirect()->back();
     }



}
