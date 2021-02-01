<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\RequestCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;


class AdminCategoryController extends Controller
{

    public function index()
    {
        $categories = Category::select('id','c_name','c_title_seo','c_active')->get(); //lấy cột nào cần thôi cho nhẹ
        $viewData = [
            'categories' => $categories
        ];
        return view('admin::category.index',$viewData);
    }
    public function create()
    {
        return view('admin::category.create');
    }
    public function store(RequestCategory $requestCategory){
  //    dd($requestCategory->all());
        $this->insertOrupdate($requestCategory);
        \Toastr::success('Thêm mới thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect()->back();

    }
    public function edit($id)
    {
        $category = Category::find($id);
            return view('admin::category.update',compact('category'));
    }

    public function update(RequestCategory $requestCategory,$id)
    {
        $this->insertOrupdate($requestCategory,$id);
        \Toastr::success('Cập nhật thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
    public function insertOrupdate($requestCategory,$id='')
    {
        $code =  1;
        try{
            $category = new Category();
            if ($id)
            {
                $category = Category::find($id);
            }
            $category->c_name = $requestCategory->name;
            $category->c_title_seo = $requestCategory->c_title_seo ? $requestCategory->c_title_seo : $requestCategory->name;
            $category->c_slug = str_slug($requestCategory->name);

            if ($requestCategory->hasFile('c_avatar'))
            {
                $file = upload_image('c_avatar');
                if (isset($file['name']))
                {
                    $category->c_avatar = $file['name'];
                }
            }
            $category->save();

        }catch (\Exception $exception)
        {
            $code = 0;
            Log::error("[Error insertOrupdate Categories ]".$exception->getMessage() );
        }
        return $code;
    }
    public function action(Request $request,$action,$id)
    {
        if ($action)
        {
            $messages = $flast = $title ='';
            $category = Category::find($id);
            $products = Product::where('pro_category_id',$id)->get()->count();
            switch ($action)
            {
                case 'delete':
                    if ($products == 0)
                    {
                        $category->delete();
                        $flast = 'success';
                        $title = 'Thành công';
                        $messages = 'Xóa thành công';
                    }
                    else
                    {
                        $flast = 'warning';
                        $title = 'Cảnh báo';
                        $messages = 'Danh mục còn sản phẩm.Không xóa được';
                    }

                    break;
                case 'active':
                    $category->c_active = $category->c_active ? 0 : 1;
                    $category->save();
                    $flast = 'success';
                    $title = 'Thành công';
                    $messages = 'Thay đổi dữ liệu thành công';
                    break;
            }
        }
        \Toastr::$flast($messages, $title, ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
}
