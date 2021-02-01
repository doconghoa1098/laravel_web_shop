@extends('layouts.app')

@section('content')
@include('components.slide')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4 style="color: #FF0000;font-weight: bold"> QUÊN MẬT KHẨU</h4></div>
                <br>
                <div class="card-body">
                    <form class="form-horizontal mb-3" action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-3 " for="pwd">Nhập địa chỉ email<br>để lấy lại mật khẩu </label>
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
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn  btn-primary">Xác nhận</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
