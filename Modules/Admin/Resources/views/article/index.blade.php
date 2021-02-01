@extends('admin::layouts.master')

@section('content')


  <div class="page-header">
    <ol class="breadcrumb">
      <li><a href="{{route('admin.home')}}">Trang chủ</a></li>
      <li class="active">Bài viết</li>
    </ol>

  </div>

  <div class="table-responsive">
      <div class="row">
          <div class="col-sm-4">
              <h2>Quản lý bài viết <a href=" {{ route('admin.get.create.article') }}" class="btn btn-xs btn-success">Thêm mới</a></h2>
          </div>
          <div class="col-sm-8"><h2>
              <form class="form-inline" action="" style="margin-bottom: 20px">
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Tên bài viết...." name="name" value="{{ \Request::get('name')}}">
                  </div>
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </form></h2>
          </div>
      </div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>

            <th >STT</th>
            <th>Mã bài viết</th>
            <th style="width: 50%">Tên bài viết</th>
            <th >Ảnh</th>
            <th >Ngày tạo</th>
            <th >Status</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>

        @if ( isset($articles))
            @php($stt=1)
            @foreach($articles as $article)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->a_name }} </td>
                    <td>
                        <img src="{{ pare_url_file($article->a_avatar) }}" alt="" class="img img-responsive" style="width: 80px;height: 80px">
                    </td>

                    <td>{{ $article->created_at }}</td>
                    <td><a href="{{ route('admin.get.action.article',['active',$article->id]) }}" class="btn btn-xs {{ $article->getStatus($article->a_active)['class'] }}">{{$article->getStatus($article->a_active)['name']}}</a></td>
                    <td>
                        <a href="{{ route('admin.get.edit.article',$article->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>Sửa</a>
                        <a href="{{ route('admin.get.action.article',['delete',$article->id]) }}" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i>Xóa</a>
                    </td>

                </tr>
                @php($stt++)
            @endforeach
        @endif

        </tbody>
    </table>
      <div class=" pull-right">{!!  $articles->links()  !!}</div>
</div>

@stop
