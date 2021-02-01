@if($orders)
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Time order</th>
            <th>Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        <?php $i =1 ; $total = 0; ?>
        @foreach($orders as $key => $order)
            <tr>
                <td>#{{ $i }}</td>
                <td align="center">{{ $order->or_product_id }}</td>
                <td><a href="">{{ isset($order->product->pro_name) ? $order->product->pro_name : '' }} </a>
                    <br>Kho còn: {{$order->product->pro_number}} sp</td>
                <td>
                    <img style="height: 100; width: 80px" src="{{ isset($order->product->pro_avatar) ? pare_url_file($order->product->pro_avatar) : '' }}" alt="">
                </td>
                <td align="center">{{$order->or_qty}}</td>
                <td>{{ fomatpricesale($order->or_price,$order->or_sale) }} VNĐ</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                <td>{{ number_format(formatpricetotal($order->or_price,$order->or_sale,$order->or_qty),0,',','.') }} VNĐ</td>
            </tr>
            <?php $i++ ; $total += formatpricetotal($order->or_price,$order->or_sale,$order->or_qty) ; ?>
        @endforeach
        </tbody>
    </table>
    <span class="pull-right" style="color: #00AA00;font-weight: bold"> Tổng tiền : {{ number_format($total,0,',','.') }} VNĐ</span><br>

@endif
