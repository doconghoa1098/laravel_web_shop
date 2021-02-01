<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestSlide;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminSlideController extends Controller
{
    public function index(Request $request)
    {
        $slides = Slide::orderBy('id','DESC')->whereRaw(1)->paginate(5);
        $products = $this->getProducts();
        $viewData = [
            'slides' => $slides,
            'products' => $products
        ];
        return view('admin::slide.index',$viewData);
    }
    public function create()
    {
        $products = $this->getProducts();
        return view('admin::slide.create',compact('products'));
    }
    public function store(RequestSlide $requestSlide)
    {
        $this->insertOrupdate($requestSlide);
        \Toastr::success('Thêm mới thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }
    public function edit($id)
    {
        $slides = Slide::find($id);
        $products = $this->getProducts();
        return view('admin::slide.update',compact('slides','products'));
    }

    public function update(Request $requestSlide,$id)
    {
        $this->insertOrupdate($requestSlide,$id);
        \Toastr::success('Cập nhật thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function getProducts()
    {
        return Product::select('id','pro_name')->orderBy('id','DESC')->get();
    }
    public function insertOrupdate($requestSlide, $id='')
    {
        $slides = new Slide();
        if ($id) $slides = Slide::find($id);
        $slides->s_product_id = $requestSlide->s_product_id;
        if ($requestSlide->hasFile('s_avatar'))
        {
            $file = upload_image('s_avatar');
            if (isset($file['name']))
            {
                $slides->s_avatar = $file['name'];
            }
        }
        $slides->s_content = $requestSlide->s_content;

        $slides->save();
    }
    public function action(Request $request,$action,$id)
    {
        if ($action)
        {
            $slides = Slide::find($id);
            $messages ='';
            switch ($action)
            {
                case 'delete':
                    $slides->delete();
                    $messages = 'Xóa thành công';
                    break;
                case 'active':
                    $slides->s_active = $slides->s_active == 1 ? 0 : 1;
                    $messages = 'Thay đổi dữ liệu thành công';
                    $slides->save();
                    break;
            }
        }
        \Toastr::success($messages, 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
