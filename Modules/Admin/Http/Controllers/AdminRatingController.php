<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminRatingController extends Controller
{

    public function index()
    {
        $ratings = Rating::with('user:id,name','product:id,pro_name,pro_slug')->paginate('10');

        $viewData = [
            'ratings' => $ratings
        ];
        return view('admin::rating.index',$viewData);
    }
    public function delete(Request $request,$id)
    {
        $ratings = Rating::find($id)->delete();
        \Toastr::success('Xóa thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


}
