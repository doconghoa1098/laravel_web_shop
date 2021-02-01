@extends('layouts.app')
@section('content')
    @include('components.slide')
    {{--    show sp hot--}}
{{--    <div class="container-fluid text-center ">--}}
{{--        <div class="row content">--}}
{{--            <div class="col-sm-2 "></div>--}}
{{--            <div class="col-sm-8 text-left ">--}}
{{--                <div class="sanpham">--}}
{{--                    <div class="row">--}}
{{--                        <div align="left" class="col-sm-6"><h3> <b> <a  href="">SẢN PHẨM NỔI BẬT</a> </b></h3></div>--}}
{{--                    </div>--}}
{{--                    @if(isset($productHot))--}}
{{--                        @foreach($productHot as $hot)--}}
{{--                    <div class="col-sm-3 item-product bor card">--}}
{{--                        <a href="{{ route('get.detail.product',[$hot->pro_slug,$hot->id]) }}">--}}
{{--                            <img src="{{ pare_url_file($hot->pro_avatar) }}" class=" img-fluid" >--}}
{{--                            <div class="info-item card-block " style=" text-overflow: ellipsis;white-space: nowrap;overflow: hidden">--}}
{{--                                <span class="card-title text-xl-center" > {{ $hot->pro_name }} </span><br>--}}
{{--                                <b class="price">{{ fomatpricesale($hot->pro_price ,$hot->pro_sale) }}</b><br>--}}
{{--                                <span class="sale"><strike class="card-text">{{ number_format($hot->pro_price,0,',','.')  }}</strike><br><b style="color: red">(-{{ $hot->pro_sale }}%)</b></span>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-2 "></div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    show sản phẩm theo danh mục--}}
<div class="container-fluid text-center ">
    <div class="row content">
        @foreach($categories as $key => $cate)
        <div class="col-sm-2 "></div>
        <div class="col-sm-8 text-left ">
            <div class="sanpham">
{{--                @if(isset($categories))--}}
                        <div class="row">
                            <div align="left" class="col-sm-6"><h3> <b> <a  href="{{ route('get.list.product',[$cate->c_slug,$cate->id]) }}"> {{ $cate->c_title_seo }} </a> </b></h3></div>
                            <div align ="right" class="col-sm-6" style="padding-top :35px; "><a  href="{{ route('get.list.product',[$cate->c_slug,$cate->id]) }}"  ><b>Xem tất cả </b></a></div>
                        </div>
            @foreach( App\Models\Product::where([ 'pro_category_id' => $cate->id, 'pro_active' => App\Models\Product::STATUS_PUBLIC, ])->orderByDesc('id')->limit(4)->get() as $product)
                        <div class="col-sm-3 item-product bor card  mt-1" name="cate">
                            <a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}">
                                @if( $product->pro_number == 0)
                                    <label style="position: absolute;background: #e91e63;color: white;padding: 2px 6px;border-radius: 11px;font-size: 13px; ">Hết hàng</label>
                                @endif
                                    <label style="position: absolute; margin-top: 76%;color: #660000;background-color: #CCFF00;padding: 2px 6px;border-radius: 11px;font-size: 13px; ">Trả góp 0%</label>

                                    <img src="{{ pare_url_file($product->pro_avatar) }}" class="img-fluid"  width="100%" style="margin: 10px;height: 200px">
                                    <div class="info-item card-block" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden">
                                    <span class="card-title text-xl-center" style=""> {{ $product->pro_name }}</span><br>
                                    <b class="price">{{ fomatpricesale($product->pro_price ,$product->pro_sale) }}</b><br>
                                    <span class="sale"><strike class="card-text">{{ number_format($product->pro_price,0,',','.')  }}</strike><br><b style="color: red">(-{{ $product->pro_sale }}%)</b></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
{{--                @endif--}}
            </div>
        </div>
        <div class="col-sm-2 "></div>
        @endforeach
    </div>
</div>

@stop
