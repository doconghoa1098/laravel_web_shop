<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct()
    {
//        $categories = Category::all();
        $categories = Category::where('c_active',1)->get();
        $slides = Slide::orderBy('id','DESC')->where('s_active',1)->get();
        View::share(['categories'=> $categories,'slides'=>$slides]);
    }

}
