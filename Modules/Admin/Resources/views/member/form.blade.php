<hr>
<div class="col-md-12">
            <form class="form-horizontal" action="" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên thành viên</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="hoadzai" name="name" value="{{ old('name',isset($user->name) ? $user->name :'') }}">
                        @if ($errors->has('name'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('name')}}
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email',isset($user->email) ? $user->email : '') }}">
                        @if ($errors->has('email'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('email')}}
                                </span>
                        @endif
                    </div>
                </div>
              {{--   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" placeholder="*******"
                               value="{{ old('password',isset($user->password) ? $user->password : '') }}"><a href="javascript:void(0)" style="position: absolute;top:25%;right: 22px"><i class="fa fa-eye"></i></a>
                        @if ($errors->has('password'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('password')}}
                                </span>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" placeholder="phone" name="phone" value="{{ old('phone',isset($user->phone) ? $user->phone : '') }}">
                        @if ($errors->has('phone'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('phone')}}
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="title-seo" name="address" value="{{ old('address',isset($user->address) ? $user->address : '') }}">
                        @if ($errors->has('address'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('address')}}
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Avatar</label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" id="input_img"  name="avatar" value="">
                        <img id="out_img"  src="{{ pare_url_file(old('avatar',isset($user->avatar) ? $user->avatar :'')) }}" alt="" style="height: 100px;width: 100px">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Chức vụ</label>
                    <div class="col-sm-3">
                        <select class="form-control col-md-8" name="roles">
                            <option value="">---Chọn chức vụ---</option>
                            @for($i=1; $i<=2; $i++)
                                <option value="{{$i}}" {{ old('roles',( isset($user->roles) ? $user->roles : '' ) == $i ? "selected ='selected'" : "" ) }}>
                                    @if($i == 1) ADMIN
                                    @elseif($i == 2)NHÂN VIÊN
                                    @endif
                                </option>
                            @endfor
                        </select>
                        @if ($errors->has('roles'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('roles')}}
                                </span>
                        @endif
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái</label>
                    <div class="col-sm-3">
                        <select class="form-control col-md-8" name="active">
                            <option value="2" {{ old('active',( isset($user->active) ? $user->active : '' ) == 2 ? "selected ='selected'" : "" ) }}>BÌNH THƯỜNG</option>
                            <option value="3" {{ old('active',( isset($user->active) ? $user->active : '' ) == 3 ? "selected ='selected'" : "" ) }}>ĐÃ NGHỈ VIỆC</option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
</div>

{{-- @section('script')
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
@stop --}}
