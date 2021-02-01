<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends FrontendController
{
    public function __construct()
    {
//        $categories = Category::all();
//        View::share('categories',$categories);
        $categories = Category::all();
        $slides = Slide::where('s_active',1)->get();
        View::share(['categories'=> $categories,'slides'=>$slides]);
    }


    public function getListProduct(Request $request)
    {
        $url = $request->segment(2);
        $url = preg_split('/(-)/i',$url);
        if ($id = array_pop($url))
        {
            $products = Product::where([
                'pro_category_id' => $id,
                'pro_active' => Product::STATUS_PUBLIC
            ]);
            $producers = Product::select('pro_producer')->where([
                'pro_category_id' => $id,
                'pro_active' => Product::STATUS_PUBLIC
            ])->distinct()->get();

            if ($request->price)
            {
                $price = $request->price;
                switch ($price)
                {
                    case '1':
                        $products->where('pro_price','<',5000000);
                        break;
                    case '2':
                        $products->whereBetween('pro_price',[5000001,10000000]);
                        break;
                    case '3':
                        $products->whereBetween('pro_price',[10000001,15000000]);
                        break;
                    case '4':
                        $products->where('pro_price','>',15000000);
                        break;
                    default:
                        break;
                }
            }


            if ($request->producer)
            {
                $producer = $request->producer;
              //  $products->where('pro_producer',$producer);
                switch ($producer)
                {
                    case $request->producer :
                        $products->where('pro_producer',$producer);
                        break;
                    case '0':
                        break;
                }
            }

            if ($request->orderby)
            {
                $orderby = $request->orderby;
                switch ($orderby)
                {
                    case 'desc':
                        $products->orderBy('id','DESC');  //desc giảm dân id (id mới -> id cũ)
                        break;
                    case 'asc':
                        $products->orderBy('id','ASC'); // asc tăng dần id (id cũ -> id mới)
                        break;
                    case 'price_asc':
                        $products->orderBy('pro_price','ASC'); //asc tăng dân giá
                        break;
                    case 'pro_desc':
                        $products->orderBy('pro_price','DESC'); //desc giảm dần giá
                        break;
                    default:
                        $products->orderBy('id','DESC');
                }
            }
            $products = $products->paginate(8);

            $cateProduct = Category::find($id);

            $viewData = [
                'products' => $products,
                'cateProduct'=> $cateProduct,
                'producers' =>$producers,
                'query' => $request->query(),

            ];
            return view('product.index',$viewData);
        }
        if ($request->k)
        {
            $products = Product::where([
                'pro_active' => Product::STATUS_PUBLIC
            ])->where('pro_name','like','%'.$request->k.'%');
            $products = $products->paginate(8);
            $viewData = [
                'products' => $products,
                'query' => $request->query(),
            ];
            return view('product.search',$viewData);

        }
        return redirect('/');
    }
}
