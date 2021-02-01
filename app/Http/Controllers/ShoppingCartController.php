<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;


class ShoppingCartController extends FrontendController
{
    /**
     *thêm vào giỏ hàng
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function addProduct(Request $request)
    {


        if ($request->ajax()) {
            $id = $request->id;
            $qty = $request->qty;
            $product = Product::select('pro_name','id','pro_price','pro_sale','pro_avatar','pro_number')->find($id);

            if (!$product) return redirect('/');
            $price = $product->pro_price;
            if ($product->pro_sale > 0)
            {
                $price = $price - ($price * $product->pro_sale) / 100;
            }
            if ($qty > $product->pro_number)
            {
                return response()->json(['code' => '2']);
            }
            else
            {
                \Cart::add([
                    'id' => $id,
                    'name' =>$product->pro_name,
                    'qty' => $qty,
                    'price' => $price,
                    'options' => [
                        'avatar' => $product->pro_avatar,
                        'sale' =>$product->pro_sale,
                        'price_old' =>$product->pro_price,
                        'pro_number' => $product->pro_number
                    ]
                ]);
                return response()->json(['code' => '1']);
            }

        }


    }
    /** danh sách giỏ hàng */
    public function getListShoppingCart()
    {
        $products = \Cart::content();
        return view('shopping.index',compact('products'));
    }
   /** form thanh toán */
    public function getFormPay()
    {
        if(\Cart::count() > 0 )
        {
            $products = \Cart::content();
            return view('shopping.pay',compact('products'));
        }
        \Toastr::warning('Không có sản phẩm nào để đặt', 'Cảnh báo', ["positionClass" => "toast-top-center"]);
        return redirect('/');
    }
    /** lưu thông tin giỏ hàng và gửi mail  */
    public function saveInfoShoppingCart(Request $request)
    {
        $totalMoney = str_replace(',','',\Cart::subtotal(0,3));
        $receiver = isset($request->receiver) ? $request->receiver : get_data_user('web','name');  //người nhận
        $receiver_phone = isset($request->receiver_phone) ? $request->receiver_phone : get_data_user('web','phone');  //sđt người nhận
        $receiver_address = isset($request->receiver_address) ? $request->receiver_address : get_data_user('web','address');  // địa chỉ người nhận


        $transactionId = Transaction::insertGetId([
            'tr_user_id' =>get_data_user('web'),
            'tr_total' => (int)$totalMoney,
            'tr_note' => $request->note,
            'tr_send_phone' => $request->phone,  //sđt người đặt
            'tr_email' => $request->email, //email người đặt
            'tr_receiver_address' => $receiver_address,  //địa chỉ nhận hàng
            'tr_receiver' => $receiver,   //người nhận
            'tr_receiver_phone' => $receiver_phone,   //sđt người nhận
            'created_at' => Carbon::now(),
        ]);

        if ($transactionId)
        {
            $products = \Cart::content();
            foreach ($products as $product)
            {
                Order::insert([
                    'or_transaction_id' => $transactionId,
                    'or_product_id' => $product->id,
                    'or_qty' => $product->qty,
                    'or_price' => $product->options->price_old,
                    'or_sale' => $product->options->sale,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            $user =  get_data_user('web','name');
            $email =  get_data_user('web','email');
            $time = Carbon::now()->format('d-m-Y');
            $data = [
                'products' => $products,
                'transactionId' => $transactionId,
                'receiver_address' => $receiver_address,
                'receiver' => $receiver,
                'receiver_phone' => $receiver_phone,
                'time' => $time,
            ];

            Mail::send('email.notification_order_success', $data, function($message) use ($email,$user){
                $message->to($email, $user)->subject('THÔNG BÁO ĐẶT HÀNG THÀNH CÔNG');
            });
        }

        \Cart::destroy();
        \Toastr::success('Đặt hàng thành công.Shop sẽ xác nhận giao hàng sớm nhất cho bạn.Cảm ơn bạn đã mua hàng', 'Thành công', ["positionClass" => "toast-top-center"]);
        return redirect('/');
    }


    /** xóa */
    public function deleteProduct($key)
    {
        \Cart::remove($key);
        \Toastr::success('Xóa sản phẩm thành công', 'Thành công', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateProduct(Request $request)
    {

        if ($request->ajax())
        {
            $rowid = $request->rowid;
            $qty = $request->qty;
            $id = $request->id;
            $product = Product::select('pro_number')->find($id);

            if ($qty > $product->pro_number)
            {
                return response()->json(['code' => '2']);
            }
            else
            {
                  \Cart::update($rowid, $qty);
                   return response()->json(['code' => '1']);
            }
        }

    }

}
