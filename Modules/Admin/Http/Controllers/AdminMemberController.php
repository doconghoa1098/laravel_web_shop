<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestPassword;
use App\Http\Requests\RequestCreateAdmin;
use App\Http\Requests\RequestUpdateAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;


class AdminMemberController extends Controller
{


    public function index()
    {

        $users = User::whereRaw(1);
        $users = $users->where([
            ['roles','<>',0],  // !=0 lấy nguyên user của admin,kinhdoanh,kho,...
            ['active','<>',4]    // !=3 để lấy ra cả nv đã nghỉ việc
        ])->orderBy('roles','ASC')->paginate(10);

        $viewData = [
           'users' => $users
        ];
        return view('admin::member.index',$viewData);
    }

    public function create()
    {
        return view('admin::member.create');
    }
    public function store(RequestCreateAdmin $request){
        $this->insertOrupdate($request);
        \Toastr::success('Thêm mới thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.get.list.member');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin::member.update',compact('user'));
    }
    public function update(RequestUpdateAdmin $request,$id)
    {
        $this->insertOrupdate($request,$id);
        \Toastr::success('Cập nhật thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.get.list.member');
    }
    public function insertOrupdate($request, $id='')
    {
        $user = new User();
        if ($id) $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->active = $request->active;
        // $user->password = $user->password == bcrypt($request->password) ? $user->password : bcrypt($request->password) ;
        $user->address = $request->address;
        $user->roles = $request->roles;
        if ($request->hasFile('avatar'))
        {
            $file = upload_image('avatar');
            if (isset($file['name']))
            {
                $user->avatar = $file['name'];
            }
        }
        $user->save();

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
                        $users->active = 1;  // xóa khỏi danh sách nhân viên nhưng vẫn dc cho là 1 khách mua hàng đã active tài khoản
                        $users->roles = 0;
                        $users->save();
                        $flast = 'success';
                        $title = 'Thành công';
                        $messages = 'Xóa thành công';
                    }
                    break;
                case 'active':
//                   1-> đã active;2-> bình thường,3->đã nghỉ việc,4-> đã band
                    if ($users->roles == 1)
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Không thể đổi trạng thái của admin';
                    }
                    else
                    {
                        $users->active = $users->active == 2  ? 3 : 2;
                        $users->save();
                        $flast = 'success';
                        $title = 'Thành công';
                        $messages = 'Thay đổi dữ liệu thành công';
                    }
                    break;
            }

        }
        \Toastr::$flast($messages, $title, ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }



    public function updatePassword()
    {
        return view('admin::member.repassword');
    }
    public function saveUpdatePassword(RequestPassword $requestPassword)
    {

        if (Hash::check($requestPassword->password_old,get_data_user('admins','password')))
        {
            $user = User::find(get_data_user('admins'));
            $user->password = bcrypt($requestPassword->password_new);
            $user->save();
            \Toastr::success('Cập nhật mật khẩu thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }

        \Toastr::warning('Mật khẩu cũ không đúng', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }

}
