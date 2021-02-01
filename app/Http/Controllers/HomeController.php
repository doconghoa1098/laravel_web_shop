<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $productHot = Product::where([
            'pro_hot' => Product::HOT_ON,
            'pro_active' => Product::STATUS_PUBLIC
        ])->limit(4)->get();  //đưa ra 4 sản phẩm hot

        $articleNews = Article::orderBy('id','DESC')->limit(4)->get();


        $categories = Category::where('c_active',1)->get();

        $slides = Slide::orderBy('id','DESC')->where('s_active',1)->get();
        $viewData = [
        'productHot' => $productHot,
        'articleNews' =>$articleNews,
        'categories' => $categories,
        'slides' => $slides,
    ];
        return view('home.index',$viewData);





    }

}
