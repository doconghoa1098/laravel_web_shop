@extends('admin::layouts.master')

@section('content')
  <div class="page-header">
    <ol class="breadcrumb">
      <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
      <li class="active">Trả góp</li>
    </ol>

  </div>

  <div class="table-responsive">
      <div class="row">
          <div class="col-sm-4">
              <h2>Quản lý trả góp <a href=" {{ route('admin.get.create.repay') }}" class="btn btn-xs btn-success">Thêm mới</a></h2>
          </div>
      </div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th >STT</th>
            <th style="width: 1%">Mã bài viết</th>
            <th style="width: 10%">Tên bài viết</th>
            <th>Ảnh</th>
            <th style="width: 40%">Nội dung</th>
            <th style="width: 10%">Ngày tạo</th>
            <th >Status</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @if ( isset($pays))
            @php($stt=1)
            @foreach($pays as $pay)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $pay->id }}</td>
                    <td>{{ $pay->p_name }} </td>
                    <td>
                        <img src="{{ pare_url_file($pay->p_avatar) }}" alt="" class="img img-responsive" style="width: 80px;height: 80px">
                    </td>
                    <td> <div style="height: 150px;overflow: auto;">{!! $pay->p_content !!}</div></td>
                    <td>{{ $pay->created_at }}</td>
                    <td>
                        @if($pay->p_active == 1)
                            <a href="{{ route('admin.get.action.repay',['active',$pay->id]) }}" class="label label-warning">Hiển thị</a>
                        @else
                           <a href="{{ route('admin.get.action.repay',['active',$pay->id]) }}" class="label label-primary">Không hiển thị</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.get.edit.repay',$pay->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>Sửa</a>
                        <a href="{{ route('admin.get.action.repay',['delete',$pay->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i>Xóa</a>
                    </td>

                </tr>
                @php($stt++)
            @endforeach
        @endif

        </tbody>
    </table>
      <div class=" pull-right">{!!  $pays->links()  !!}</div>
</div>

@stop
