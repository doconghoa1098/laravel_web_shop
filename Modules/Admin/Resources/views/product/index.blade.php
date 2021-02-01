@extends('admin::layouts.master')

@section('content')
    <style>
        .rating .active {color: #ff9705 !important;}
    </style>


  <div class="page-header">
    <ol class="breadcrumb">
      <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
      <li class="active">Sản phẩm</li>
    </ol>

  </div>
  <div class="table-responsive">
      <div class="row">
          <div class="col-sm-4">
              <h2>Quản lý sản phẩm <a href=" {{ route('admin.get.create.product') }}" class="btn btn-xs btn-success">Thêm mới</a></h2>
          </div>
          <div class="col-sm-8"><h2>
              <form class="form-inline" action="" style="margin-bottom: 20px">
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Tên sản phẩm...." name="name" value="{{ \Request::get('name')}}">
                  </div>
                  <div class="form-group">
                      <select name="cate" id="" class="form-control">
                          <option value="">Danh mục</option>
                          @if(isset($categories))
                              @foreach($categories as $category)
                                  <option value="{{ $category->id }}" {{ \Request::get('cate') == $category->id ? "selected ='selected'" : "" }}> {{ $category->c_name }} </option>
                              @endforeach
                          @endif
                      </select>
                  </div>
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </form></h2>
          </div>
      </div>
{{--    <h2>Quản lý sản phẩm <a href=" {{ route('admin.get.create.product') }}" class="btn btn-xs btn-success">Thêm mới</a></h2>--}}
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th> Mã sp</th>
            <th>Tên sản phẩm</th>
{{--            <th>Danh mục</th>--}}
            <th>Nhà sản xuất</th>
            <th>Ảnh</th>
            <th>Price</th>
            <th>Sale</th>
            <th>Số lượng</th>
            <th>Status</th>
            <th>Hot</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @if ( isset($products))
            @php($stt=1)
            @foreach($products as $product)
                <?php $age = 0;
                 if ($product->pro_total_rating)
                     {
                         $age = round($product->pro_total_number / $product->pro_total_rating, 2);
                     }

                ?>
                <tr >
                    <td>{{ $stt }}</td>
                    <td>{{ $product->id }}</td>
                    <td><a href="#">{{ $product->pro_name }}</a> <br>
                        <span class="rating">
                            @for($i=1;$i<=5;$i++)
                                <i class="fa fa-star {{ $i <= $age ? 'active' : '' }}"></i>
                            @endfor
                        </span>
                        <span>{{ $age }}</span>
                    </td>
{{--                    <td>{{ isset($product->category->c_name) ? $product->category->c_name : '[N\A]'}}</td>--}}
                    <td>{{ $product->pro_producer }}</td>
                    <td>
                        <img src="{{ pare_url_file($product->pro_avatar) }}" alt="" class="img img-responsive" 
                        style="width: 80px;height: 80px;">
                    </td>
                    <td>{{ number_format($product->pro_price,0,',','.') }} VNĐ</td>
                    <td>{{ $product->pro_sale }}%</td>
                    <td>
                        @if($product->pro_number > 0)
                            {{ $product->pro_number }}
                        @else
                            <a href="" class="label label-default">Hết hàng</a><br>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.get.action.product',['active',$product->id]) }}" class="btn btn-xs {{ $product->getStatus($product->pro_active)['class'] }}">{{$product->getStatus($product->pro_active)['name']}}</a></td>
                    <td><a href="{{ route('admin.get.action.product',['hot',$product->id]) }}" class="btn btn-xs {{ $product->getHot($product->pro_hot)['class'] }}">{{$product->getHot($product->pro_hot)['name']}}</a></td>
                    <td>
                        <a href="{{ route('admin.get.edit.product',$product->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Sửa</a>
                        <a href="{{ route('admin.get.action.product',['delete',$product->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i>Xóa</a>
                    </td>
                    </td>
                </tr>
                @php($stt++)
            @endforeach
        @endif

        </tbody>
    </table>
      <div class=" pull-right">{!!  $products->links()  !!}</div>
</div>

@stop
