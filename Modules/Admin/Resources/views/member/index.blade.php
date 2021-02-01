@extends('admin::layouts.master')

@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
            <li class="active">Thành viên</li>
        </ol>

    </div>
    <div class="table-responsive">
        <h2>Quản lý thành viên <a href="{{ route('admin.get.create.member') }}" class="btn btn-xs btn-success">Thêm mới</a></h2>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Avatar</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Chức vụ</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i =1 ;?>
            @if(isset($users))
                    @foreach($users as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if($user->avatar)
                                    <img src="{{ pare_url_file($user->avatar) }}" alt="" class="img img-responsive" style="width: 80px;height: 80px; border-radius: 50%;">
                                @else
                                    <img src="/image/img-default.jpg" alt="" class="img img-responsive" style="width: 80px;height: 80px; border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                @if($user->roles == 1)
                                    <a href="#" class="label label-warning">ADMIN</a>
                                @elseif($user->roles == 2)
                                    <a href="#"  class="label label-default">NHÂN VIÊN</a>
                                @endif
                            </td>
                            <td>
{{--                              1-> đã active;2-> bình thường,3->đã nghỉ việc,4-> đã band --}}
                                @if($user->active == 0)
                                    <a href="#" class="label label-primary">Chưa active</a>
                                @elseif($user->active == 2)
                                    <a href="{{ route('admin.get.action.member',['active',$user->id])}}" class="label label-warning">Bình thường</a>
                                @elseif($user->active == 3)
                                    <a href="{{ route('admin.get.action.member',['active',$user->id])}}"  class="label label-default">Đã nghỉ việc</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.get.edit.member',$user->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>Sửa</a>
                                <a href="{{ route('admin.get.action.member',['delete',$user->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i>Xóa</a>
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
