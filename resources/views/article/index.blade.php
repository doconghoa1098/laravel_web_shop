@extends('layouts.app')
@section('content')
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 ">
            </div>
            <div class="col-sm-8 text-left ">
                <div class="row">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                        <li class="active">Bài viết</li>
                    </ul>
                </div>
                 @include('components.article')
            </div>
            <div class="col-sm-2 ">

            </div>
        </div>

    </div>
@stop
