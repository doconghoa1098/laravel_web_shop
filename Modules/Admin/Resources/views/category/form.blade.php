<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" class="form-control" placeholder="Điện Thoại" value="{{ old('name',isset($category->c_name) ? $category->c_name :'') }}" name="name">
        @if ($errors->has('name'))
            <span class="errors-text" style="color: red;font-style: italic; font-size: 12px;">
                          {{$errors->first('name')}}
                      </span>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Home title</label>
        <input type="text" class="form-control" placeholder="home title" value="{{ old('c_title_seo',isset($category->c_title_seo) ? $category->c_title_seo : '') }}" name="c_title_seo">
    </div>
    <div class="form-group">
        <label for="inputEmail3" >Hình ảnh</label>
            <input type="file" class="form-control" id="input_img"  name="c_avatar" style="width: 20%" >
        <img id="out_img"  src="{{ pare_url_file(old('c_avatar',isset($category->c_avatar) ? $category->c_avatar :''))}}" alt="" style="height: 100px;width: 100px">
    </div>

    <button type="submit" class="btn btn-success ">Lưu thông tin</button>
</form>

