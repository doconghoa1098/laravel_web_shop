<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mail;


class AdminTransactionController extends Controller
{

    public function index(Request $request)
    {
        $transactions = Transaction::with('user:id,name,phone')->orderBy('tr_status','ASC');
        if ($request->trasacton) $transactions->where('tr_status',($request->trasacton) - 1);

        $transactions = $transactions->paginate(10);
        $viewData = [
            'transactions' => $transactions
        ];
        return view('admin::transaction.index',$viewData);
    }
    public function viewOrder(Request $request,$id)
    {
        if ($request->ajax())
        {
            $orders = Order::with('product')
                ->where('or_transaction_id',$id)->get();
            $html = view('admin::components.order',compact('orders'))->render();
            return \response()->json($html);
        }
    }
    public function action(Request $request,$action,$id)
    {
        if ($action)
        {
            $messages ='';
            $transactions = Transaction::find($id);
            switch ($action)
            {
                case 'delete':
                    $transactions->delete();
                    $messages = 'Xóa thành công';
                    break;
                case 'active':
                    $transactions->tr_status = $transactions->tr_status == 0 ? 1 : 0;
                    $transactions->created_at = time();
                    $transactions->tr_handler = get_data_user('admins','name');
                    $messages = 'Xử lý đơn hàng thành công';
                    $transactions->save();
                    break;
                case 'done':
                    $transactions->tr_status = $transactions->tr_status == 1 ? 2 : 1;
                    $transactions->updated_at = time();
                    $transactions->tr_shipper = get_data_user('admins','name');
                    $messages = 'Xử lý đơn hàng thành công';
                    $transactions->save();
                    break;
            }
            $tr_name = User::select('name')->where('id',$transactions->tr_user_id)->first();
            $email = $transactions->tr_email;
            $user = $tr_name->name;
            $orders = Order::with('product')->where('or_transaction_id',$id)->get();
            if ($orders && $transactions->tr_status == 1)  //tồn tại order và đã xử lý chuyển cho giao hàng (tr_status = 1 )
            {
                foreach ($orders as $order)
                {
                    $product = Product::find($order->or_product_id);
                    $product->pro_number = $product->pro_number - $order->or_qty;  // trừ đi số sản phẩm đã mua
                    $product->pro_pay ++;
                    $product->save();
                    $time = $order->created_at->format('d-m-Y');
                }

                $data = [
                    'orders' => $orders,
                    'transactions' => $transactions,
                    'user' => $user,
                    'time' => $time,
                ];
                Mail::send('admin::transaction.daxulygiaohang', $data, function($message) use ($email, $user){
                    $message->to($email, $user)->subject('THÔNG BÁO ĐƠN HÀNG ĐANG ĐƯỢC GIAO ');
                });
            }
            if ($orders && $transactions->tr_status == 2)  //tồn tại order và đã giao hàng thành công(tr_status = 2 )
            {
                foreach ($orders as $order) {$time = $order->created_at->format('d-m-Y');}
                $data = [
                    'orders' => $orders,
                    'transactions' => $transactions,
                    'user' => $user,
                    'time' => $time,
                ];
                Mail::send('admin::transaction.daxulygiaohang', $data, function($message) use ($email,$user){
                    $message->to($email, $user)->subject('THÔNG BÁO ĐÃ GIAO HÀNG THÀNH CÔNG');
                });
            }
        }

        \Toastr::success($messages, 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


}
