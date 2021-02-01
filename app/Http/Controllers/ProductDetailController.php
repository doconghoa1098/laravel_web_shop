<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductDetailController extends FrontendController
{


    public function productDetail(Request $request)
    {
        $url = $request->segment(2);
        $url = preg_split('/(-)/i',$url);

        if ($id = array_pop($url))
        {
            $productDetail = Product::where('pro_active',Product::STATUS_PUBLIC)->find($id);

            $productFollows = Product::where('pro_category_id',$productDetail->pro_category_id)->where('pro_active',Product::STATUS_PUBLIC)
                ->orderBy('id',"DESC")->limit(4)->get();

            $ratings = Rating::with('user:id,name')
                ->where('ra_product_id',$id)->orderBy('id',"DESC")->paginate(10);


//tính tổng sô sao
            $ratingsDashboard = Rating::groupBy('ra_number')
                ->where('ra_product_id',$id)
                ->select(DB::raw('count(ra_number) as total'),DB::raw('sum(ra_number) as sum'),'ra_number')
                ->get()->toArray();

            $arrayRatings = [];
            if (!empty($ratingsDashboard))
            {
                for ($i =5; $i>0; $i--)
                {
                    $arrayRatings[$i]= [
                        "total" => 0,
                        "sum" => 0,
                        "ra_number" => 0
                    ];
                    foreach ($ratingsDashboard as $item)
                    {
                        if ($item['ra_number'] == $i)
                        {
                            $arrayRatings[$i] = $item;
                            continue;
                        }
                    }
                }
            }

            $viewData = [
               'productDetail' => $productDetail,
                'ratings' =>$ratings,
                'productFollows' => $productFollows,
                'arrayRatings' => $arrayRatings
            ];
            return view('product.detail',$viewData);
        }


    }

}
