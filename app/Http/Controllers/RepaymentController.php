<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function getPay(Request $request)
    {
    	if ($request->ajax())
        {
            $repayments = Pay::where('p_active',1)->orderBy('id','ASC')->get();
            $html = view('repayment.index',compact('repayments'))->render();
            return \response()->json($html);
        }
    
    }
}
