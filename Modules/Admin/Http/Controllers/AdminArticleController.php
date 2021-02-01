<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestArticle;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::orderBy('id','DESC')->whereRaw(1);
        if ($request->name) $articles->where('a_name','like','%'.$request->name.'%');
        $articles =$articles->paginate(5);
        $viewData = [
            'articles' => $articles
        ];
        return view('admin::article.index',$viewData);
    }
    public function create()
    {

        return view('admin::article.create');
    }
    public function store(RequestArticle $requestArticle){
       $this->insertOrupdate($requestArticle);
        \Toastr::success('Thêm mới thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
       return redirect()->back();

    }
    public function edit($id)
    {
        $article = Article::find($id);
        return view('admin::article.update',compact('article'));
    }

    public function update(RequestArticle $requestArticle,$id)
    {
        $this->insertOrupdate($requestArticle,$id);
        \Toastr::success('Cập nhật thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function insertOrupdate($requestArticle, $id='')
    {
        $article = new Article();
        if ($id) $article = Article::find($id);
        $article->a_name = $requestArticle->a_name;
        $article->a_slug = str_slug($requestArticle->a_name);
        $article->a_title_seo = $requestArticle->a_title_seo ? $requestArticle->a_title_seo : $requestArticle->a_name;
        $article->a_description = $requestArticle->a_description ? $requestArticle->a_description : $requestArticle->a_name;
        $article->a_content = $requestArticle->a_content;

        if ($requestArticle->hasFile('a_avatar'))
        {
            $file = upload_image('a_avatar');
            if (isset($file['name']))
            {
                $article->a_avatar = $file['name'];
            }
        }

        $article->save();
    }
    public function action(Request $request,$action,$id)
    {
        if ($action)
        {
            $article = Article::find($id);
            $messages ='';
            switch ($action)
            {
                case 'delete':
                    $article->delete();
                    $messages = 'Xóa thành công';
                    break;
                case 'active':
                    $article->a_active = $article->a_active == 1 ? 0 : 1;
                    $messages = 'Thay đổi dữ liệu thành công';
                    $article->save();
                    break;
            }
        }
        \Toastr::success($messages, 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


}
