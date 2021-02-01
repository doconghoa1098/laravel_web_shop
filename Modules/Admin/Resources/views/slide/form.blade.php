<div class="col-md-12">
            <form class="form-horizontal" action="" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Sản phẩm gắn với slide</label>
                    <div class="col-sm-8">
                        <select class="form-control col-md-8" name="s_product_id">
                            <option value="">---Chọn sản phẩm khuyến mại ---</option>
                            @if(isset($products))
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('s_product_id',( isset($slides->s_product_id) ? $slides->s_product_id : '' ) == $product->id ? "selected ='selected'" : "" ) }}> {{ $product->pro_name }} </option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('s_product_id'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('s_product_id')}}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Ảnh slide</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="input_img"  name="s_avatar" >
                        <img id="out_img"  src="{{ pare_url_file( old('s_avatar',isset($slides->s_avatar) ? $slides->s_avatar :'') ) }}" alt="" style="height: 250px;width: 100%">
                    @if ($errors->has('s_avatar'))
                            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                              {{$errors->first('s_avatar')}}
                          </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả ngắn (nếu có)</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="s_content" placeholder="Mô tả ngắn nếu có" value="{{old('s_content',isset($slides->s_content) ? $slides->s_content :'')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>

