<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;



class AdminProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::with('category:id,c_name');

        if ($request->name) $products->where('pro_name','like','%'.$request->name.'%');
        if ($request->cate) $products->where('pro_category_id',$request->cate);

        $products =$products->orderByDesc('id')->paginate(10);
        $categories = $this->getCategories();

        $viewData = [
            'products' => $products,
            'categories' => $categories
        ];
        return view('admin::product.index',$viewData);
    }
    public function create()
    {
        $categories = $this->getCategories();
        return view('admin::product.create',compact('categories'));
    }
    public function store(RequestProduct $requestProduct)
    {
        //dd($requestProduct->all());
        $this->insertOrupdate($requestProduct);
        \Toastr::success('Thêm mới thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = $this->getCategories();
        return view('admin::product.update',compact('product','categories'));
    }
    public function update(RequestProduct $requestProduct,$id)
    {
        $this->insertOrupdate($requestProduct,$id);
        \Toastr::success('Cập nhật thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function getCategories()
    {
        return Category::all();
    }
    public function insertOrupdate($requestProduct,$id='')
    {
        $product = new Product();

        if ($id) $product = Product::find($id);
        $product->pro_category_id = $requestProduct->pro_category_id;
        $product->pro_name = $requestProduct->pro_name;
        $product->pro_producer = $requestProduct->pro_producer;
        $product->pro_slug = str_slug($requestProduct->pro_name);
        $product->pro_price = $requestProduct->pro_price;
        $product->pro_sale = $requestProduct->pro_sale;
        $product->pro_number = $requestProduct->pro_number;
        $product->pro_content = $requestProduct->pro_content;
        $product->pro_description = $requestProduct->pro_description;

        if ($requestProduct->hasFile('pro_avatar'))
        {
            $file = upload_image('pro_avatar');
            if (isset($file['name']))
            {
                $product->pro_avatar = $file['name'];
            }
        }

        $product->save();

    }

    public function action(Request $request,$action,$id)
    {
        if ($action)
        {
            $product = Product::find($id);
            $messages ='';
            switch ($action)
            {
                case 'delete':
                    $product->delete();
                    $messages = 'Xóa thành công';
                    break;
                case 'active':
                    $product->pro_active = $product->pro_active ? 0 : 1;
                    $messages = 'Thay đổi dữ liệu thành công';
                    $product->save();
                    break;
                case 'hot':
                    $product->pro_hot = $product->pro_hot ? 0 : 1 ;
                    $messages = 'Thay đổi dữ liệu thành công';
                    $product->save();
                    break;
            }

        }
        \Toastr::success($messages, 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


}
