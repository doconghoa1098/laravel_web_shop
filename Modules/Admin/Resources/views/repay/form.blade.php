<div class="col-md-12">
            <form class="form-horizontal" action="" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên chương trình</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="hoadzai" name="p_name" value="{{ old('p_name',isset($pays->p_name) ? $pays->p_name :'') }}">
                        @if ($errors->has('p_name'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('p_name')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hình ảnh</label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" id="input_img"  name="p_avatar" value="">
                        <img id="out_img"  src="{{ pare_url_file(old('p_avatar',isset($pays->p_avatar) ? $pays->p_avatar :''))}}" alt="" style="height: 100px;width: 100px">

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="a_content" name="p_content" rows="10" placeholder="Nội dung chi tiết tin tức" >{{old('p_content',isset($pays->p_content) ? $pays->p_content :'')}}</textarea>
                        @if ($errors->has('p_content'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('p_content')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>

@section('script')
 <script src="{{ asset('theme_admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var editor = CKEDITOR.replace('p_content',{
          language : 'vi',
          filebrowserImageBrowseUrl : "{{ asset('ckfinder/ckfinder.html?Type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('ckfinder/ckfinder.html?Type=Flash') }}",
          filebrowserImageUploadUrl : "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
        });
    </script>
@stop
