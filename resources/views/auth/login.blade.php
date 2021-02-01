@extends('layouts.app')

@section('content')
@include('components.slide')
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-3 ">
            </div>
            <div class="col-sm-6 text-left">

                <h4 style="color: #FF0000;font-weight: bold"> ĐĂNG NHẬP THÀNH VIÊN</h4><hr>
                <form class="form-horizontal" action="{{ route('post.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-3 " for="pwd">Email </label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control " name="email" placeholder="hoadzai@gmail.com" value="{{old('email')}}">
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
                            @if( \Session::has('danger'))
                                <div  style="color: red;font-style: italic; font-size: 15px;" align="center">
                                    {{ \Session::get('danger') }} !
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10 ">
                            <button type="submit" class="btn btn-primary ">Đăng nhập</button>
                            <a href="{{ route('get.reset.password') }}" >Quên mật khẩu ???</a>
                        </div>

                    </div>
                </form>


            </div>
            <div class="col-sm-3">
            </div>
        </div>

    </div>

@endsection