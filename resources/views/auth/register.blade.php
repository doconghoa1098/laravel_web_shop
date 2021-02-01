@extends('layouts.app')

@section('content')
@include('components.slide')

    <div class="container">
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-3 sidenav">
            </div>
            <div class="col-sm-6 text-left ">

                <h4 style="color: #FF0000;font-weight: bold"> ĐĂNG KÝ THÀNH VIÊN</h4><hr>

                <form class="form-horizontal" action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="name">Tên thành viên</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" placeholder="Đỗ Công Hòa" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('name')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" name="email" placeholder="hoadzai@gmail.com" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('email')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" placeholder="*******" value="{{old('password')}}">
                            @if ($errors->has('password'))
                                <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('password')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">Số điện thoại</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="phone" placeholder="1123456789" value="{{old('phone')}}">
                            @if ($errors->has('phone'))
                                <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('phone')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">Địa chỉ</label>
                        <div class="col-sm-7">
                            <input type="text"  class="form-control" name="address" placeholder="hoadzai" value="{{old('address')}}">
                            @if ($errors->has('address'))
                                <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('address')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                            <a href="{{ route('get.login') }}">Đã có tài khoản ?????</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-3 sidenav">
            </div>
        </div>
    </div>
</div>
@endsection
