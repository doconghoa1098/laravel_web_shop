
<div marginheight="0" marginwidth="0" style="background:#f0f0f0">
    <div id="wrapper" style="background-color:#f0f0f0">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
            <tbody>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff">
                    <table style="width:580px;border-bottom:1px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td align="left" valign="middle" style="width:500px;height:60px">
                                <a href="#" style="border:0" target="_blank" width="130" height="35" style="display:block;border:0px">
                                    <img src="https://i.imgur.com/i2gDtFs.jpg" height="100" width="115" style="display:block;border:0px;float: left;">
                                    <b style="float: left;line-height: 100px;color: red;font-size: 20px;">LAPLAPSHOP</b>
                                </a>
                            </td>
                            <td align="right" valign="middle" style="padding-right:15px">
                                <a href="" style="border:0">
                                    <img src="https://i.imgur.com/eL1uAJx.png" height="36" width="115" style="display:block;border:0px">
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff">
                    <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                Thông báo tình trạng đơn hàng
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                Chào {{ $user }},
                                <br> Cảm ơn bạn đã mua sắm tại <b style="color: red">LAPLAPSHOP</b>
                                <br>
                                <br> Đơn hàng của bạn
                                 @if($transactions->tr_status == 1)
                                    <b>đã được xử lý và đang được giao </b>(trong vòng 3-5 ngày)
                                    <br> Chúng tôi sẽ thông tin <b>trạng thái đơn hàng</b> trong email tiếp theo.
                                    <br> Bạn vui lòng kiểm tra email thường xuyên nhé.
                                @elseif($transactions->tr_status == 2)
                                    <b>đã được được giao <h4>Thành công</h4></b>
                                    <br>CẢM ƠN BẠN ĐÃ TIN DÙNG SẢN PHẨM CỦA SHOP
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff">
                    <table style="width:580px;border:1px solid #ff3333;border-top:3px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#666666;padding:10px 10px 20px 15px;line-height:17px">
                                <b>Đơn hàng của bạn #</b>
                                <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">{{$transactions->id}}
                                </a>
                                <span style="font-size:15px">({{ $time }})</span>
                            </td>
                        </tr>
                        <?php  $total = 0; ?>
                        @foreach($orders as $key => $order)
                            <tr>
                                <td align="left" valign="top" style="width:120px;padding-left:15px">
                                    <a href="#_" style="border:0">
                                        <img src="{{pare_url_file( $order->product->pro_avatar) }}" height="70" width="100" style="display:block;border:0px">
                                    </a>
                                </td>
                                <td align="left" valign="top">
                                    <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px">
                                                <b>Sản phẩm</b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                <a href="#" style="color:#115fff;text-decoration:none" target="_blank">{{ $order->product->pro_name }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px">
                                                <b>Số lượng</b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                x{{$order->or_qty }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                                <b>Thành tiền</b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                {{ number_format(formatpricetotal($order->or_price,$order->or_sale,$order->or_qty),0,',','.') }} VNĐ
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php $total += formatpricetotal($order->or_price,$order->or_sale,$order->or_qty) ?>
                        @endforeach
                        <tr>
                            <td align="left" valign="top" style="width:120px;padding-left:15px">
                            </td>
                            <td align="left" valign="top">
                                <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                    <hr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                            <b>Tổng tiền</b>
                                        </td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                            <b style="color: red">{{ number_format($total,0,',','.') }} VNĐ</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                            <b>Người nhận</b>
                                        </td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                            <b>{{$transactions->tr_receiver}}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                            <b>Số điện thoại</b>
                                        </td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                            {{$transactions->tr_receiver_phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                            <b>Địa chỉ nhận</b>
                                        </td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                            {{$transactions->tr_receiver_address}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                    <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td align="center" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                Đây là thư tự động từ hệ thống. Vui lòng không trả lời email này.
                                <br> Nếu có bất kỳ thắc mắc hay cần giúp đỡ, Bạn vui lòng ghé thăm
                                <b style="font-family:Arial,Helvetica,sans-serif;font-size:13px;text-decoration:none;font-weight:bold">Trung tâm trợ giúp</b> của chúng tôi tại địa chỉ:
                                <a href="#" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold" target="_blank">
                                    laplapshop.vn
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
