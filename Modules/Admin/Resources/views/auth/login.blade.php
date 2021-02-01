<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<title>Trang Quản Trị</title>

<body>

<div class="container" style="margin-top: 200px;">
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Đăng nhập trang quản trị</div>
            </div>

            <div class="panel-body" >

                <form action="" name="form" id="form" class="form-horizontal" method="POST">
                    @csrf
                    <div class="input-group" style="margin-bottom: 15px">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user" type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email...">
                        @if ($errors->has('email'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                          {{$errors->first('email')}}
                            </span>
                        @endif
                    </div>

                    <div class="input-group" style="margin-bottom: 15px">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password..." >
                        @if ($errors->has('password'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('password')}}
                                </span>
                        @endif
                    </div>
                    @if( \Session::has('danger'))
                        <div  style="color: red;font-style: italic; font-size: 15px;" align="center">
                            {{ \Session::get('danger') }} !
                        </div>
                    @endif

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" href="#" class="btn btn-primary pull-right">
                                <i class="glyphicon glyphicon-log-in"></i> Đăng nhập</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div id="particles"></div>
</body>
