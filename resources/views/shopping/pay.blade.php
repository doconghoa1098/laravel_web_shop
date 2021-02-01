@extends('layouts.app')
@section('content')
    @include('components.slide')
    <div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">

        </div>
        <div class="col-sm-8 text-left ">
            <h3 style="color: #FF0000"><b> Thanh toán đơn hàng </b></h3><hr>
            <div class="container wrapper">
                <div class="row cart-body">
                    <form class="form-horizontal col-sm-12" method="post" action="">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                            <!--REVIEW ORDER-->
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                   Danh sách sản phẩm <div class="pull-right"><small><a class="afix-1" href="{{ route('get.list.shopping.cart') }}">Chỉnh sửa</a></small></div>
                                </div>
                                <div class="panel-body">
                                    @foreach($products as $product)
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-3">
                                            <img class="img-responsive" style="width: 100px;height: 70px" src="{{pare_url_file( $product->options->avatar) }}" />
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="col-xs-12">{{ $product->name }}</div>
                                            <div class="col-xs-12"><small>Số lượng: x<span>{{$product->qty }}</span></small></div>
                                        </div>
                                        <div class="col-sm-3 col-xs-3 text-right">
                                            <h6><span>{{ number_format($product->price * $product->qty,0,',','.') }} VNĐ</span></h6>
                                        </div>
                                    </div>
                                    <div class="form-group"><hr /></div>
                                    @endforeach
                                    <div class="form-group">
                                        <div class="col-xs-12" style="color: red">
                                            <strong>Tổng tiền (VAT+SALE)</strong>
                                            <div class="pull-right"><span>{{ \Cart::subtotal(0,'.','.') }}</span><span> VNĐ</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--REVIEW ORDER END-->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                            <!--SHIPPING METHOD-->
                            <div class="panel panel-info">
                                <div class="panel-heading">Thông tin thanh toán</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Người đặt:</strong></div>
                                        <div class="col-md-12">
                                            <input type="text" readonly="" name="name" class="form-control" value="{{ get_data_user('web','name') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Email:</strong></div>
                                        <div class="col-md-12"><input readonly="" type="text" name="email" class="form-control" value="{{ get_data_user('web','email') }}" /></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Số điện thoại người đặt:</strong></div>
                                        <div class="col-md-12"><input type="text" readonly="" name="phone" class="form-control" value="{{ get_data_user('web','phone') }}" /></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Người nhận:</strong></div>
                                        <div class="col-md-12">
                                            <input type="text" name="receiver" class="form-control" value="{{ isset($request->receiver) ? $request->receiver : get_data_user('web','name')}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Số điện thoại người nhận:</strong></div>
                                        <div class="col-md-12"><input type="text" name="receiver_phone" class="form-control" value="{{ isset($request->receiver_phone) ? $request->receiver_phone : get_data_user('web','phone') }}" /></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Địa chỉ nhận:</strong></div>
                                        <div class="col-md-12">
                                            <input type="text" name="receiver_address" class="form-control" value="{{ isset($request->receiver_address) ? $request->receiver_address : get_data_user('web','address') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Ghi chú:</strong></div>
                                        <div class="col-md-12">
                                            <textarea name="note"  class="form-control" rows="5">{{ old('note')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Xác nhận thông tin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--SHIPPING METHOD END-->
                        </div>

                    </form>
                </div>
                <div class="row cart-footer">
                </div>
            </div>


        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>
@stop
