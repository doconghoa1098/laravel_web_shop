<div class="col-md-12">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục sản phẩm</label>
                    <div class="col-sm-8">
                        <select class="form-control col-md-8" name="pro_category_id">
                          <option value="">---Chọn danh mục sản phẩm---</option>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('pro_category_id',( isset($product->pro_category_id) ? $product->pro_category_id : '' ) == $category->id ? "selected ='selected'" : "" ) }}> {{ $category->c_name }} </option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('pro_category_id'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('pro_category_id')}}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Asus" name="pro_name" value="{{ old('pro_name',isset($product->pro_name) ? $product->pro_name :'') }}">
                        @if ($errors->has('pro_name'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('pro_name')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nhà sản xuất</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Asus" name="pro_producer" value="{{ old('pro_producer',isset($product->pro_producer) ? $product->pro_producer :'') }}">
                        @if ($errors->has('pro_producer'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('pro_producer')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="10.000.000" name="pro_price" value="{{old('pro_price',isset($product->pro_price) ? $product->pro_price :'')}}" min="0">
                        @if ($errors->has('pro_price'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('pro_price')}}
                          </span>
                        @endif
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá (%)</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="10 %" name="pro_sale" value="{{old('pro_sale',isset($product->pro_sale) ? $product->pro_sale :'0')}}" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputEmail3"  name="pro_number" value="{{old('pro_number',isset($product->pro_number) ? $product->pro_number :'')}}" min="1" >
                        @if ($errors->has('pro_number'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('pro_number')}}
                          </span>
                        @endif
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">Hình ảnh</label>
                    <div class="col-sm-3">
                     <input type="file" class="form-control" id="input_img"  name="pro_avatar" >
{{--                        <p>{{ old('pro_avatar',isset($product->pro_avatar) ? $product->pro_avatar :'') }}</p>--}}
                        <img id="out_img"  src="{{ pare_url_file(old('pro_avatar',isset($product->pro_avatar) ? $product->pro_avatar :''))}}" alt="" style="height: 100px;width: 100px">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Thông số kĩ thuật</label>
                    <div class="col-sm-8">
                        <textarea class="form-control " id="pro_content " name="pro_content" rows="10" placeholder="Thông số sản phẩm" >{{old('pro_content',isset($product->pro_content) ? $product->pro_content :'')}}</textarea>
                        @if ($errors->has('pro_content'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('pro_content')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-8">
                        <textarea class="form-control ckeditor" name="pro_description" rows="10" placeholder="Mô tả sản phẩm" >{{old('pro_description',isset($product->pro_description) ? $product->pro_description :'')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
</div>
@section('script')
 <script src="{{ asset('theme_admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var editor = CKEDITOR.replace('pro_description',{
          language : 'vi',
          filebrowserImageBrowseUrl : "{{ asset('ckfinder/ckfinder.html?Type=Images') }}",
          filebrowserFlashBrowseUrl : "{{ asset('ckfinder/ckfinder.html?Type=Flash') }}",
          filebrowserImageUploadUrl : "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
          filebrowserFlashUploadUrl : "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
        });
    </script>
 <script type="text/javascript">
     config = {};
     config.toolbarGroups = [
         { name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
         { name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
         { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
         { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
         { name: 'forms', groups: [ 'forms' ] },
         { name: 'colors', groups: [ 'colors' ] },
         { name: 'links', groups: [ 'links' ] },
         { name: 'insert', groups: [ 'insert' ] },
         { name: 'tools', groups: [ 'tools' ] },
         { name: 'others', groups: [ 'others' ] },
         { name: 'about', groups: [ 'about' ] },
         { name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
         { name: 'styles', groups: [ 'styles' ] },

     ];
     config.removeButtons = 'About,ShowBlocks,Image,Flash,Table,HorizontalRule,SpecialChar,PageBreak,Iframe,Anchor,Unlink,Link,BidiLtr,BidiRtl,Language,CreateDiv,Outdent,Indent,CopyFormatting,Subscript,Superscript,RemoveFormat,Form,Radio,Select,Button,ImageButton,HiddenField,Textarea,TextField,SelectAll,Find,Replace,Cut,Templates,Save,NewPage,Print,Checkbox,Blockquote,PasteText,PasteFromWord,Copy';

     CKEDITOR.replace('pro_content',config);
 </script>
@stop
