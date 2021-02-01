@extends('admin::layouts.master')

@section('content')
  <div class="page-header">
    <ol class="breadcrumb">
      <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
      <li class="active">Slide</li>
    </ol>

  </div>

  <div class="table-responsive">
      <div class="row">
          <div class="col-sm-4">
              <h2>Quản lý trả góp <a href=" {{ route('admin.get.create.slide') }}" class="btn btn-xs btn-success">Thêm mới</a></h2>
          </div>
      </div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th title="ảnh mới sẽ được hiển thi trước"  style="width:30%">Slide Ảnh</th>
            <th>Sản phẩm</th>
            <th >Mô tả ngắn (nếu có) </th>
            <th >Ngày tạo</th>
            <th >Status</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @if (isset($slides))
            @php($stt=1)
            @foreach($slides as $slide)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>
                        <img src="{{ pare_url_file($slide->s_avatar) }}" alt="" class="img img-responsive" style="width: 400px;height: 100px">
                    </td>
                    <td>
                        @foreach($products as $product)
                            <a href="">{{ $product->id == $slide->s_product_id ? $product->pro_name : '' }}</a>
                        @endforeach
                    </td>
                    <td>{{$slide->s_content}}</td>
                    <td>{{ $slide->created_at->format('d-m-Y') }}</td>
                    <td>
                        @if($slide->s_active == 1)
                            <a href="{{ route('admin.get.action.slide',['active',$slide->id]) }}" class="label label-warning">Hiển thị</a>
                        @else
                           <a href="{{ route('admin.get.action.slide',['active',$slide->id]) }}" class="label label-primary">Không hiển thị</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.get.edit.slide',$slide->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>Sửa</a>
                        <a href="{{ route('admin.get.action.slide',['delete',$slide->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i>Xóa</a>
                    </td>

                </tr>
                @php($stt++)
            @endforeach
        @endif

        </tbody>
    </table>
      <div class=" pull-right">{!!  $slides->links()  !!}</div>
</div>

@stop
