@extends('layouts.app')

@section('content')
@include('components.slide')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4 style="color: #FF0000;font-weight: bold"> ĐỔI MẬT KHẨU</h4></div>
                <br>
                <div class="card-body">
                    <form class="form-horizontal" action="" method="POST" >
                        @csrf
                        <div class="form-group" style="position: relative">
                            <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email"  readonly="" class="form-control" id="inputEmail3" name="email" placeholder="hoadzai@gmail.com" value="{{ $email }}">
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="inputEmail3" class="col-sm-3 control-label">Mật khẩu mới</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputEmail3" placeholder="********" name="password_new" value="" >
                                <a href="javascript:void(0)" style="position: absolute;top:25%;right: 22px"><i class="fa fa-eye"></i></a>
                                @if ($errors->has('password_new'))
                                    <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('password_new')}}
                          </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="inputEmail3" class="col-sm-3 control-label">Xác nhận mật khẩu</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputEmail3" placeholder="********" name="password_confim" value="">
                                <a href="javascript:void(0)" style="position: absolute;top:25%;right: 22px"><i class="fa fa-eye"></i></a>
                                @if ($errors->has('password_confim'))
                                    <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('password_confim')}}
                          </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10 ">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Cập nhật</button>
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

@section('script')
    <script>
        $(function(){
            $(".form-group a").click(function () {
                let $this = $(this);
                if($this.hasClass('active'))
                {
                    $this.parents('.form-group').find('input').attr('type','text')
                    $this.removeClass('active');
                }else
                {
                    $this.parents('.form-group').find('input').attr('type','password')
                    $this.addClass('active');
                }
            });
        })
    </script>
@stop
