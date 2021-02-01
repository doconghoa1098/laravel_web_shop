@extends('admin::layouts.master')

@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
            <li class="active">Đơn hàng</li>
        </ol>

    </div>
    <div class="table-responsive">
        <div class="row">
            <h2><div class="col-sm-8">Quản lý đơn hàng </div></h2>
            <div class="col-sm-4">
                    <form class="form-inline" action="" style="margin-bottom: 20px">
                        <div class="form-group">
                            <select name="trasacton" id="" class="form-control">
                                <option value="0">Trạng thái đơn hàng</option>
                                <option value="1"  {{ \Request::get('trasacton') == 1 ? "selected ='selected'" : "" }}>Chưa xử lý</option>
                                <option value="2"  {{ \Request::get('trasacton') == 2 ? "selected ='selected'" : "" }}>Đã xử lý,Chờ giao hàng</option>
                                <option value="3"  {{ \Request::get('trasacton') == 3 ? "selected ='selected'" : "" }}>Đã giao hàng thành công</option>
                                <option value="4"  {{ \Request::get('trasacton') == 4 ? "selected ='selected'" : "" }}>Đã bị hủy</option>
{{--                                @if(isset($categories))--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <option value="{{ $category->id }}" {{ \Request::get('trasac') == $category->id ? "selected ='selected'" : "" }}> {{ $category->c_name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
                            </select>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>

                    </form>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Thông tin khách hàng</th>
                <th>Thông tin người nhận</th>
                <th>Tổng tiền</th>
                <th>Ghi chú</th>
                <th style="text-align: center">Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php $i =1 ;?>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $i }}</td>

                    <td>
                        <i class="fa fa-user col-lg-1 pull-left" title="Người đặt"></i>{{ isset($transaction->user->name) ? $transaction->user->name : '[N\A]' }}<br>
                        <i class="fa fa-mail-bulk col-lg-1 pull-left" title="Email"></i>{{ $transaction->tr_email }}<br>
                        <i class="fa fa-mobile-alt col-lg-1 pull-left" title="Số điện thoại"></i>{{ $transaction->user->phone }}
                    </td>
                    <td>
                        <i class="fa fa-user col-lg-1 pull-left" title="Người nhận"></i>{{ $transaction->tr_receiver }}<br>
                        <i class="fa fa-address-card col-lg-1 pull-left" title="Địa chỉ nhận"></i>{{ $transaction->tr_receiver_address }}<br>
                        <i class="fa fa-mobile-alt col-lg-1 pull-left" title="Số điện thoại"></i>{{ $transaction->tr_receiver_phone }}
                    </td>
                    <td>{{ number_format($transaction->tr_total,0,',','.') }} VNĐ</td>
                    <td>{{ $transaction->tr_note }}</td>
                    <td>
                            @if($transaction->tr_status == 0)
                                <p><a href="{{ route('admin.get.action.order',['active',$transaction->id])}}" class="label label-default" title="Chưa xử lý">Chưa xử lý</a></p>
                                Ngày đặt: {{ $transaction->created_at->format('d-m-Y / H:m:s') }}
                            @elseif($transaction->tr_status == 1)
                                <p><a href="{{ route('admin.get.action.order',['done',$transaction->id])}}"  class="label label-warning" title="Chờ giao hàng">Đã xử lý, Chờ giao hàng</a></p>
                                Xử lý: {{ $transaction->tr_handler }} ( {{ $transaction->created_at->format('d-m-Y / H:m:s') }})
                            @elseif($transaction->tr_status == 2)
                                <p><a href="#" class="label label-danger" title="Đã giao hàng">Đã giao hàng</a></p>
                                Xử lý: {{ $transaction->tr_handler }} ( {{ $transaction->created_at->format('d-m-Y / H:m:s') }})
                                <br>Giao hàng: {{ $transaction->tr_shipper }} ( {{ $transaction->updated_at->format('d-m-Y / H:m:s') }})
                            @else
                                <p><a href="#" class="label label-info" title="Đã bị khách hủy">Đã hủy</a></p>
                                Ngày hủy: {{ $transaction->updated_at->format('d-m-Y / H:m:s') }}
                            @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.get.action.order',['delete',$transaction->id])}}" class="btn btn-xs btn-danger" ><i class="fa fa-trash-alt"></i> Xóa</a>
                        <a href="{{ route('admin.get.view.order',$transaction->id ) }}" class="btn btn-xs btn-warning js_order_item" data-id="{{$transaction->id}}"><i class="fa fa-eye"></i> Xem</a>
{{--                        <br><br>--}}
{{--                        <a href="" class="btn btn-xs btn-primary"><i class="fa fa-file-export"></i> Xuất hóa đơn</a>--}}
                    </td>
                </tr>
                <?php $i++ ;?>
            @endforeach

            </tbody>
        </table>
        <div class=" pull-right">{!!  $transactions->links()  !!}</div>

    </div>
    <div class="modal fade" id="myModalOrder" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chi tiết đơn hàng #<b class="transaction_id"></b></h4>
                </div>
                <div class="modal-body" id="md_content">
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

                $("#myModalOrder").modal('show');
                $.ajax({
                    url: url,
                }).done(function (result) {
                    if(result)
                    {
                        $("#md_content").html('').append(result);
                    }
                    // console.log(result);
                });
            });
        })
    </script>
@stop
