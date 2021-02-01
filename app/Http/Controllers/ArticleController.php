<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends FrontendController
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getListArticle()
    {
        $articles = Article::orderBy('id','DESC')->paginate(3);

        return view('article.index',compact('articles'));
    }

    public function getDetailArticle(Request $request)
    {
        $arrayUrl = (preg_split("/(-)/i",$request->segment(2))); //bóc phần tử sau / thứ 2 và theo dấu - trên url

        $id = array_pop($arrayUrl); //lấy phần tử cuối cùng là id

        if($id)
        {
             $articleDetail = Article::find($id);
            $articles = Article::paginate(10);

            $viewData = [
                'articleDetail' => $articleDetail,
                'articles' => $articles
            ];
            return view('article.detail',$viewData);
        }
        return redirect('/');


    }
}
