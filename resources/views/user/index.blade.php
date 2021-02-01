@extends('layouts.app')
@section('content')
    @include('components.slide')
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
            </div>
            <div class="col-sm-8 text-left ">
                <h2 style="color: #00AA00">Tổng quan</h2>
                <table class="table table-bordered table-hover"  >
                    <thead>
                    <tr>
                        <th style="text-align: center">Tổng số đơn hàng</th>
                        <th style="text-align: center">Chưa được xử lý</th>
                        <th style="text-align: center">Đã được xử lý</th>
                        <th style="text-align: center">Đã nhận hàng</th>
                        <th style="text-align: center">Đã hủy</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td><i class="fa fa-2x">{{$totalTransaction}}</i></td>
                            <td><i class="fa fa-2x">{{$totalTransactionUnhanled}}</i></td>
                            <td><i class="fa fa-2x">{{$totalTransactionHandle}}</i></td>
                            <td><i class="fa fa-2x">{{$totalTransactionDone}}</i></td>
                            <td><i class="fa fa-2x">{{$totalTransactionExit}}</i></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h2 style="color: #00AA00">Đơn hàng của bạn</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Thông tin người nhận</th>
                        <th>Tổng tiền</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($transactions))
                    <?php $i =1 ;?>
                    @foreach($transactions as $transacton)
                        <tr>
                            <td>#{{ $i }}</td>
                            <td>
                                <i class="fa fa-user col-lg-1 pull-left" title="Người nhận"></i><b> {{ $transacton->tr_receiver }}</b><br>
                                <i class="fa fa-address-card col-lg-1 pull-left" title="Địa chỉ nhận"></i><b> {{ $transacton->tr_receiver_address }}</b><br>
                                <i class="fa fa-mobile-alt col-lg-1 pull-left" title="Số điện thoại"></i><b>{{ $transacton->tr_receiver_phone }}</b>
                            </td>
                            <td>{{ number_format($transacton->tr_total,0,',','.') }} VNĐ</td>
                            <td>{{ $transacton->tr_note }}</td>
                            <td>
                                @if($transacton->tr_status == 0)
                                    <a href="#" class="label label-default" title="Chưa xử lý">Chờ xử lý</a><br>
                                    Ngày đặt: {{ $transacton->created_at->format('d-m-Y') }}
                                @elseif($transacton->tr_status == 1)
                                    <a href="#" class="label label-warning" title="Chờ giao hàng">Đã xử lý, Chờ giao hàng</a><br>
                                    Ngày xử lý: {{ $transacton->created_at->format('d-m-Y')  }}
                                @elseif($transacton->tr_status == 2)
                                    <a href="#" class="label label-danger" title="Đã giao hàng">Đã giao hàng</a><br>
                                    Ngày giao hàng: {{ $transacton->updated_at->format('d-m-Y') }}
                                @else
                                    <a href="#" class="label label-info" title="Đã hủy">Đã hủy</a><br>
                                    Ngày hủy: {{ $transacton->updated_at->format('d-m-Y') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.view.order',$transacton->id) }}" class="btn btn-xs btn-warning js_order_item " data-id="{{$transacton->id}}"><i class="fa fa-eye"></i> Xem</a>
                                @if($transacton->tr_status == 0 || $transacton->tr_status == 1)
{{--                                    <a href="{{ route('user.exit.order',$transacton->id) }}" class="btn btn-xs btn-info "><i class="fa fa-remove"></i> Hủy</a>--}}
                                    <a href="{{ route('user.exit.order',$transacton->id) }}" class="btn btn-xs btn-info huy_don_hang" data-id="{{$transacton->id}}"><i class="fa fa-remove"></i> Hủy</a>
                                @endif
                            </td>
                        </tr>
                        <?php $i++ ;?>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                <div class=" pull-right" style="margin-top: -4%;">{!!  $transactions->links()  !!}</div>

                <hr><hr>
                <h2 style="color: #00AA00;">Thông tin của bạn
                    @if(get_data_user('web','active')==0)
                        <a href="{{route('get.active.account')}}" class="btn btn-xs btn-default" title="kích hoạt ngay">NO ACTIVE</a>
                    @elseif(get_data_user('web','active')==4)
                        <a href="#" class="btn btn-xs btn-danger">BỊ KHÓA</a>
                    @else
                        <a href="#" class="btn btn-xs btn-primary">ĐÃ ACTIVE</a>
                    @endif
                </h2>
                <form class="form-horizontal" action="" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Họ tên</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Họ tên" name="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputEmail3" placeholder="phone" name="phone" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="inputEmail3" placeholder="address" name="address" value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 ">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Cập nhật</button>
                            <a href="{{ route('user.update.password') }}">Đổi mật khẩu ?????</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalOrder111" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chi tiết đơn hàng #<b class="transaction_id"></b></h4>
                </div>
                <div class="modal-body" id="md_content111">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
@stop
@section('script')
    <script>
        $(function(){
            $(".js_order_item").click(function (event) {
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                $(".transaction_id").text('').text($this.attr('data-id'));

                 $("#myModalOrder111").modal('show');
                $.ajax({
                    url: url,
                }).done(function (result) {
                    if(result)
                    {
                        $("#md_content111").html('').append(result);
                    }
                    //  console.log(result);
                });
            });

            $(".huy_don_hang").click(function (e) {
                e.preventDefault();
                let $this = $(this);
                let $id = $this.attr('data-id') ;
                let url = $this.attr('href');
                let a = confirm('Bạn có chắc là muốn hủy đơn hàng này không???');
                if(a == true){
                    top.location = url;
                };
            });
        });
    </script>
@stop
