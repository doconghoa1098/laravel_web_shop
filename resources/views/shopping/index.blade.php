@extends('layouts.app')
@section('content')
    @include('components.slide')
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
            </div>
            <div class="col-sm-8 text-left ">

                <h3 style="color: #FF0000"><b> Giỏ hàng của bạn </b></h3>
                <hr>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>

                        </tr>
                        </thead>
                        <tbody id="tbody">

                        <?php $stt=1; ?>
                        @foreach($products as $key => $product)
{{--                            {{dd($products)}}--}}

                    <form  action="" method="POST">
                        @csrf
                        <tr>
                            <td>{{ $stt }}</td>
                            <td><a href="{{ route('get.detail.product',[str_slug($product->name),$product->id]) }}">{{ $product->name }}</a></td>
                            <td>
                                <img src="{{ pare_url_file($product->options->avatar) }} " width="60px" height="60px" >
                            </td>
                            <td>
                                <input type="number"  value="{{$product->qty}}" class="form-control qty" id="qty" min="1" max="{{$product->options->pro_number}}" style="width: 70px" >
                                (Còn {{$product->options->pro_number}} sp)
                            </td>
                            <td>{{ number_format($product->price,0,',','.') }} VNĐ</td>
                            <td>{{ number_format( $product->price * $product->qty, 0,',','.')  }} VNĐ</td>
                            <td>
                                <a href="#" class="updatecart btn btn-xs btn-info" data-key="{{ $key }}" id="{{$product->id}}"><i class="fa fa-edit"></i> Cập nhật</a>
                                <a href="{{ route('delete.shopping.cart',$key) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i> Xóa</a>
                            </td>

                        </tr>
                        </form>
                            <?php $stt++ ;?>
                        @endforeach
                        </tbody>
                    </table>
                <hr>
                <div class=" pull-right">
                            <b style="color: #2d995b ">TỔNG TIỀN CẦN THANH TOÁN: {{ \Cart::subtotal(0,',','.') }} VNĐ</b><br>
                    <a href="{{ route('home') }}" class="btn btn-primary">TIẾP TỤC MUA HÀNG</a>
                    @if(\Cart::count() > 0 )
                    <a href="{{route('get.form.repay')}}"class="btn btn-warning">THANH TOÁN</a>
                    @endif

                </div>

            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>

    </div>
    </div>

@stop

@section('script')
    <script>

        $(function () {
            $(".updatecart").click(function (e) {
                e.preventDefault();
                $rowid = $(this).attr('data-key');
                $qty = $(this).parent().parent().find('#qty').val();
                $id = $(this).attr('id');
                $.ajax({
                    url: '/shopping/update/'+$rowid+'/'+$qty,
                    type: 'GET',
                    data : {'rowid': $rowid, 'qty' : $qty, 'id' : $id},
                    success:function (result) {
                        if(result.code == 1)
                        {
                            alert('Cập nhật sản phẩm thành công');
                            location.reload();
                        }
                        if(result.code == 2)
                        {
                            alert('Số lượng sản phẩm trong kho không đủ.\n Vui lòng liên hệ admin để đặt hàng!!!');
                            location.reload();
                        }
                    }
                });

            });
        });
    </script>
@stop
