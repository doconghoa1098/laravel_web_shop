@extends('admin::layouts.master')

@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
            <li class="active">Người dùng</li>
        </ol>

    </div>
    <div class="table-responsive">
        <h2>Quản lý người dùng </h2>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody> <?php $i =1 ;?>
                @if(isset($users))
                    @foreach($users as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $user->name }}
                                @if($user->roles == 1)
                                    <a href="#" class="label label-warning">ADMIN</a>
                                @elseif($user->roles == 2 && $user->active == 2)
                                    <a href="#"  class="label label-default">NHÂN VIÊN</a>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
{{--                              1-> đã active;2-> bình thường,3->đã nghỉ việc,4-> đã band --}}
                                @if($user->active == 0)
                                    <a href="{{route('admin.get.action.user',['active',$user->id])}}"  class="label label-info">Chưa active</a>
                                @else
                                    <a href="{{route('admin.get.action.user',['active',$user->id])}}"  class="label label-primary">Đã active</a>
                                @endif
                                @if($user->active != 4)
                                    <a href="{{route('admin.get.action.user',['band',$user->id])}}" class="label label-warning">Bình thường</a>
                                @else
                                    <a href="{{route('admin.get.action.user',['band',$user->id])}}"  class="label label-default">Đã band</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.get.action.user',['delete',$user->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i> Xóa</a>
                            </td>
                        </tr>
                        <?php $i++ ;?>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class=" pull-right">{!!  $users->links()  !!}</div>
    </div>

@stop
