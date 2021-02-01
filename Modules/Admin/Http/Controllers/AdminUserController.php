<?php

namespace Modules\Admin\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::whereRaw(1);
        $users = $users->orderBy('id','DESC')->paginate(10);

        $viewData = [
           'users' => $users
        ];
        return view('admin::user.index',$viewData);
    }
    public function action(Request $request,$action,$id)
    {
        if ($action)
        {
            $users = User::find($id);
            $messages = $flast = $title ='';
            switch ($action)
            {
                case 'delete':
                    if ($users->roles == 1)
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể xóa admin';
                    }//                  2-> bình thường,3->đã nghỉ việc
                    elseif ($users->roles != 1 &&  $users->active == 2 )
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể xóa nhân viên chưa nghỉ việc';
                    }
                    else
                    {
                        $users->delete();
                        $flast = 'success';
                        $title = 'Thành công';
                        $messages = 'Xóa thành công';
                    }
                    break;
                case 'band':
//                    1-> đã active;2-> bình thường,3->đã nghỉ việc,4-> đã band
                    // roles = 1->admin
                    if ($users->roles == 1)
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể band admin ';
                    }
                    elseif ($users->roles != 1 &&  $users->active == 2 )
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể band nhân viên';
                    }
                    else
                    {
                        $active = $users->active == 1 ? 1 : 3;
                        $users->active = $users->active == 1 || $users->active == 3  ? 4 : $active ;
                        $users->save();
                        $flast = 'success';
                        $title = 'Thành công';
                        $messages = 'Thay đổi dữ liệu thành công';
                    }
                    break;
                case 'active':
                    if ($users->roles == 1)
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể đổi dữ liệu của admin ';
                    }
                    elseif ($users->roles != 1 &&  $users->active == 2 )
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể đổi dữ liệu của nhân viên ';
                    }
                    else {
                        $active = $users->active == 1 ? 1 : 3;
                        $users->active = $users->active == 1 || $users->active == 3  ? 0 : $active ;
                        $users->save();
                        $flast = 'success';
                        $title = 'Thành công';
                        $messages = 'Thay đổi dữ liệu thành công';
                        break;
                    }
            }

        }
        \Toastr::$flast($messages, $title, ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }

}
