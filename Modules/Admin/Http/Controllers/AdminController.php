<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::select('id')->get()->count();
        $users = User::select('id')->get()->count();

        $day = Carbon::now()->format('Y-m-d');
        $moneyDay = Transaction::whereDay('updated_at',date('d'))
            ->where('tr_status',2)->sum('tr_total');

        $moneyMonth = Transaction::whereMonth('updated_at',date('m'))
            ->where('tr_status',2)->sum('tr_total');

        $moneyYear = Transaction::whereYear('updated_at',date('Y'))
            ->where('tr_status',2)->sum('tr_total');

        //thống doanh thu theo request ngày tháng năm

        $url = $request->date ? $request->date : $day;
        $date = (preg_split("/(-)/i", $url)); //bóc $request->date thành 1 mảng theo dấu - : [0][1][2] = năm tháng ngày
        if ($date[2])
        {
            $moneyDay = Transaction::whereDay('updated_at',$date[2])->where('tr_status',2)->sum('tr_total');
        }
        if ($date[1])
        {
            $moneyMonth = Transaction::whereMonth('updated_at',$date[1])->where('tr_status',2)->sum('tr_total');
        }
        if ($date[0])
    {
        $moneyYear = Transaction::whereYear('updated_at',$date[0])->where('tr_status',2)->sum('tr_total');
    }

        $moneyMonth = $moneyYear == 0 || $moneyMonth > $moneyYear ? 0 : $moneyMonth;  //doanh thu năm ==0 or < doanh thu tháng thì doanh thu tháng = 0;
        $moneyDay =  $moneyMonth == 0 || $moneyDay > $moneyMonth ? 0 : $moneyDay;  //doanh thu tháng ==0 or < doanh thu ngày thì doanh thu ngày = 0;

        $dataMoney = [
            [
                "name" => "Doanh thu ngày $date[2]/$date[1]/$date[0]",
                 "y" => (int)$moneyDay
            ],
            [
                "name" => "Doanh thu tháng $date[1]/$date[0]",
                "y" => (int)$moneyMonth
            ],
            [
                "name" => "Doanh thu năm $date[0] ",
                "y" => (int)$moneyYear
            ]
        ];


//        $transactionNews = Transaction::with('user:id,name,phone')->where('tr_status',0)->limit(5)->orderByDesc('id')->get();
        $transactionNews = Transaction::select('id')->where('tr_status',0)->get()->count(); //số đơn hàng mới chưa xử lý
        $transactionFee = Transaction::select('id')->where('tr_status',1)->get()->count(); //số đơn hàng đang vận chuyển
        $transactionSuccess = Transaction::select('id')->where('tr_status',2)->get()->count(); //số đơn hàng đã xử lý vận chuyển thành công
        $transactions = Transaction::select('id')->get()->count(); //tổng số đơn hàng

        $viewData = [
            'products' => $products,
            'users' => $users,
            'moneyDay' => $moneyDay,
            'dataMoney' =>  json_encode($dataMoney),
            'transactionNews' => $transactionNews,
            'transactions' => $transactions,
            'transactionFee' => $transactionFee,
            'transactionSuccess' => $transactionSuccess,
            'day' => $day,

        ];
        return view('admin::index',$viewData);
    }

}
