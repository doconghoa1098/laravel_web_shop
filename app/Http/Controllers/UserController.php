<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPassword;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        $transactions = Transaction::where('tr_user_id',get_data_user('web'))->orderBy('tr_status','ASC')->paginate(5);


        $totalTransaction = Transaction::where('tr_user_id',get_data_user('web'))->select('id')->count();

        $totalTransactionUnhanled = Transaction::where('tr_user_id',get_data_user('web'))->where('tr_status',0)->select('id')->count();

        $totalTransactionHandle = Transaction::where('tr_user_id',get_data_user('web'))->where('tr_status',1)->select('id')->count();

        $totalTransactionDone = Transaction::where('tr_user_id',get_data_user('web'))->where('tr_status',2)->select('id')->count();

        $totalTransactionExit = Transaction::where('tr_user_id',get_data_user('web'))->where('tr_status',3)->select('id')->count();

        $user = User::find(get_data_user('web'));

        $viewData = [
          'totalTransaction' => $totalTransaction,
          'totalTransactionUnhanled' => $totalTransactionUnhanled,
            'totalTransactionHandle' =>$totalTransactionHandle,
            'totalTransactionDone' => $totalTransactionDone,
            'totalTransactionExit' => $totalTransactionExit,
            'transactions' => $transactions,
            'user' => $user
        ];
        return view('user.index',$viewData);
    }


    public function viewOrder(Request $request,$id)
    {
        if ($request->ajax())
        {
            $orders = Order::with('product')
                ->where('or_transaction_id',$id)->get();
            $html = view('user.vieworder',compact('orders'))->render();
            return \response()->json($html);
        }
    }

    public function exitOrder($id)
    {
        $transaction = Transaction::find($id);
        $transaction->tr_status = 3;
        $transaction->updated_at = time();
        $transaction->save();

        $orders = Order::where('or_transaction_id',$id)->get();
        if ($orders && $transaction->tr_status == 3)  //tồn tại order và bị hủy (tr_status = 3 )
        {
            foreach ($orders as $order)
            {
                $product = Product::find($order->or_product_id);
                $product->pro_number = $product->pro_number + $order->or_qty;  // Cộng lại số sp đã trừ đi khi mk xử lý trc đó đã trừ
                $product->pro_pay --;
                $product->save();
            }
        }
        \Toastr::success('Hủy đơn hàng thành công', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
    //lấy thông tin
    public function updateInfo()
    {
      //  $user = User::find(get_data_user('web'));
     //   return view('user.index',compact($user));
    }
    //lưu thông tin
    public function saveUpdateInfo(Request $request)
    {
        User::where('id',get_data_user('web'))
            ->update($request->except('_token'));

        \Toastr::success('Cập nhật thông tin thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updatePassword()
    {
        return view('user.password');
    }
    public function saveUpdatePassword(RequestPassword $requestPassword)
    {

        if (Hash::check($requestPassword->password_old,get_data_user('web','password')))
        {
            $user = User::find(get_data_user('web'));
            $user->password = bcrypt($requestPassword->password_new);
            $user->save();
            \Toastr::success('Cập nhật mật khẩu thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        \Toastr::warning('Mật khẩu cũ không đúng', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
