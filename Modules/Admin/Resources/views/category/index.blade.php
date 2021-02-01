@extends('admin::layouts.master')

@section('content')
  <div class="page-header">
    <ol class="breadcrumb">
      <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
      <li class="active">Danh mục</li>
    </ol>

  </div>
  <div class="table-responsive">
    <h2>Quản lý danh mục <a href=" {{ route('admin.get.create.category') }}" class="btn btn-xs  btn-success">Thêm mới</a></h2>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Title Seo</th>
            <th>Status</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @if ( isset($categories))
            @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->c_name }}</td>
            <td>{{ $category->c_title_seo }}</td>
            <td>
                <a href="{{ route('admin.get.action.category',['active',$category->id] ) }}" class="btn btn-xs {{ $category->getStatus($category->c_active)['class'] }}">{{ $category->getStatus($category->c_active)['name']}}</a>
            </td>
            <td>
                <a href="{{ route('admin.get.edit.category',$category->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>Sửa</a>
                <a href="{{ route('admin.get.action.category',['delete',$category->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i>Xóa</a>
            </td>
        </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

@stop
