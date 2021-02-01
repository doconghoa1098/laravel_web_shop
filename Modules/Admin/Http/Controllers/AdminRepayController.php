<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestPay;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminRepayController extends Controller
{
    public function index(Request $request)
    {
        $pays = Pay::orderBy('id','DESC')->whereRaw(1)->paginate(3);
        $viewData = [
            'pays' => $pays
        ];
        return view('admin::repay.index',$viewData);
    }
    public function create()
    {
        return view('admin::repay.create');
    }
    public function store(RequestPay $requestPay){
       $this->insertOrupdate($requestPay);
        \Toastr::success('Thêm mới thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }
    public function edit($id)
    {
        $pays = Pay::find($id);
        return view('admin::repay.update',compact('pays'));
    }

    public function update(RequestPay $requestPay,$id)
    {
        $this->insertOrupdate($requestPay,$id);
        \Toastr::success('Cập nhật thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function insertOrupdate($requestPay, $id='')
    {
        $pay = new Pay();
        if ($id) $pay = Pay::find($id);
        $pay->p_name = $requestPay->p_name;
        $pay->p_slug = str_slug($requestPay->p_name);
        $pay->p_content = $requestPay->p_content;

        if ($requestPay->hasFile('p_avatar'))
        {
            $file = upload_image('p_avatar');
            if (isset($file['name']))
            {
                $pay->p_avatar = $file['name'];
            }
        }

        $pay->save();
    }
    public function action(Request $request,$action,$id)
    {
       if ($action)
       {
           $pay = Pay::find($id);
           $messages ='';
           switch ($action)
           {
               case 'delete':
                   $pay->delete();
                   $messages = 'Xóa thành công';
                   break;
               case 'active':
                   $pay->p_active = $pay->p_active == 1 ? 0 : 1;
                   $messages = 'Thay đổi dữ liệu thành công';
                   $pay->save();
                   break;
           }
       }
       \Toastr::success($messages, 'Thành công', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }


}
