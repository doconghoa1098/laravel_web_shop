@extends('admin::layouts.master')

@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
            <li class="active">Đánh giá</li>
        </ol>

    </div>
    <div class="table-responsive">
        <h2>Quản lý đánh giá </h2>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Điểm đánh giá</th>
                <th>Ngày đánh giá</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($ratings))
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{ $rating->id }}</td>
                        <td>{{ isset($rating->user->name) ? $rating->user->name : '[N|A]' }}</td>
                        <td><a href="{{route('get.detail.product',[$rating->product->pro_slug,$rating->product->id] ) }}">{{ isset($rating->product->pro_name) ? $rating->product->pro_name : '[N|A]' }}</a></td>
                        <td>{{ $rating->ra_content }}</td>
                        <td>{{ $rating->ra_number }}</td>
                        <td>{{ $rating->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.get.delete.rating',$rating->id) }}" class="btn btn-xs btn-danger" ><i class="fa fa-trash-alt"></i> Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class=" pull-right">{!!  $ratings->links()  !!}</div>
    </div>

@stop
