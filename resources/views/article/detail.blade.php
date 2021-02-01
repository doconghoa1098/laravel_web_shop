@extends('layouts.app')
@section('content')
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-left ">

                <div class="row">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                        <li><a href="{{ route('get.list.article') }}">Bài viết</a></li>
                        <li class="active">{{ $articleDetail->a_name }}</li>
                    </ul>
                </div>
                @if(isset($articleDetail))
                    <div class="article_content">
                        <h2 style="color: #0000cc; margin-top: -5px;">{{ $articleDetail->a_name }}</h2>
                        <p>{{ $articleDetail->a_title_seo }}</p>
                        <div>
                            {!! $articleDetail->a_content !!}
                        </div>
                    </div>
                @endif
                <hr>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>
@stop



