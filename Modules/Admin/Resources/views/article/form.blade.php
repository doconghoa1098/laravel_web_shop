<div class="col-md-12">
            <form class="form-horizontal" action="" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên bài viết</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="hoadzai" name="a_name" value="{{ old('a_name',isset($article->a_name) ? $article->a_name :'') }}">
                        @if ($errors->has('a_name'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('a_name')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Title home</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="title-seo" value="{{ old('a_title_seo',isset($article->a_title_seo) ? $article->a_title_seo : '') }}" name="a_title_seo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hình ảnh</label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" id="input_img"  name="a_avatar" value="">
                        <img id="out_img"  src="{{ pare_url_file(old('a_avatar',isset($article->a_avatar) ? $article->a_avatar :''))}}" alt="" style="height: 100px;width: 100px">

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="a_content" name="a_content" rows="10" placeholder="Nội dung chi tiết tin tức" >{{old('a_content',isset($article->a_content) ? $article->a_content :'')}}</textarea>
                        @if ($errors->has('a_content'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('a_content')}}
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
 {{-- <script src="{{asset('vendor/jquery.min.js')}}"></script> --}}
 <script src="{{ asset('theme_admin/js/bootstrap.min.js') }}"></script>
    {{-- <script>
        CKEDITOR.replace('a_content');
    </script> --}}
    <script type="text/javascript">
        var editor = CKEDITOR.replace('a_content',{
          language : 'vi',
          filebrowserImageBrowseUrl : "{{ asset('ckfinder/ckfinder.html?Type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('ckfinder/ckfinder.html?Type=Flash') }}",
          filebrowserImageUploadUrl : "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
        });
    </script>
@stop
