@extends('layouts.app')
@section('content')
    @include('components.slide')
    <style>
        .sidebar-content .active{
            color: #c2a476;
        }
    </style>
    <div class="sanpham">
        <div class="container">
            <hr>
            <div class="row">
                <div class="  col-sm-2 ">
                    <div class=" " align="center">
                        <h3 > <b><a href="?" name="loai">{{ $cateProduct->c_title_seo }}  </a></b></h3>
                    </div>
                    <div class="mucgia">
                        <p>Mức giá</p>
                        <aside class="sidebar-content">
                            <ul>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 0]) }}" class="{{ Request::get('price') == 0 ? 'active' : '' }} ">
                                        <input type="radio" {{ Request::get('price') == 0 ? "checked" : '' }} > Tất cả</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 1]) }}" class="{{ Request::get('price') == 1 ? 'active' : '' }} ">
                                        <input type="radio" {{ Request::get('price') == 1 ? "checked" : '' }} > Dưới 5tr</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 2]) }}" class="{{ Request::get('price') == 2 ? 'active' : '' }} ">
                                        <input type="radio" {{ Request::get('price') == 2 ? "checked" : '' }} > 5 - 10 triệu</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 3]) }}" class="{{ Request::get('price') == 3 ? 'active' : '' }} ">
                                        <input type="radio" {{ Request::get('price') == 3 ? "checked" : '' }} > 10 - 15 triệu</a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 4]) }}" class="{{ Request::get('price') == 4 ? 'active' : '' }} ">
                                        <input type="radio" {{ Request::get('price') == 4 ? "checked" : '' }} > Trên 15 triệu</a>
                                </li>
                            </ul>
                        </aside>
                        <hr>
                    </div>
                    <div class="hangsanxuat" >
                        <p>Hãng sản xuất</p>
                        <aside class="sidebar-content">
                        <ul>
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['producer' => 0 ]) }}" class="{{ Request::get('producer') == 0 ? 'active' : '' }} " >
                                    <input type="radio" {{ Request::get('producer') == 0 ? "checked" : '' }} > Tất cả</a>
                            </li>
                            @foreach($producers as $producer)
                            <li>
                                <a href="{{ request()->fullUrlWithQuery(['producer' => $producer->pro_producer ]) }}" class="{{ Request::get('producer') == $producer->pro_producer ? 'active' : '' }} " >
                                    <input type="radio" {{ Request::get('producer') == $producer->pro_producer ? "checked" : '' }} > {{$producer->pro_producer}}</a>
                            </li>
                            @endforeach
                        </ul>
                        </aside>
                        <hr>
                    </div>

                </div>
                <div class="phai col-sm-10">

                    <div class=" mucdich">
                       <div class="col-xs-12 nopadding-left">
                           <form action="" id="form_order" method="get">
                               <div class="order-by-wrapper pull-right">
                                   <span>Sắp xếp </span>
                                   <select name="orderby" class="orderby" >
                                       <option {{ Request::get('orderby') == "md"|| !Request::get('orderby') ? "selected = 'selected' " : '' }} name="loai" value="md" selected="selected">Mặc định</option>
                                       <option {{ Request::get('orderby') == "desc" ? "selected = 'selected' " : '' }} name="loai" value="desc" >Mới Nhất</option>
                                       <option {{ Request::get('orderby') == "asc" ? "selected = 'selected' " : '' }} name="loai" value="asc" >Sản phẩm cũ</option>
                                       <option {{ Request::get('orderby') == "price_asc" ? "selected = 'selected' " : '' }} name="loai" value="price_asc" >Giá tăng dần</option>
                                       <option {{ Request::get('orderby') == "price_desc" ? "selected = 'selected' " : '' }} name="loai" value="price_desc" >Giá giảm dần</option>
                                   </select>
                               </div>
                           </form>
                       </div>
                        <hr>
                        <div class=" col-sm-12">
                        @if(isset($products))
                            @foreach($products as $product)
                                    <div class="col-sm-3 item-product bor card  mt-1">
                                        <a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}">
                                            @if( $product->pro_number == 0)
                                                <label style="position: absolute;margin-top: 7%;background: #e91e63;color: white;padding: 2px 6px;border-radius: 11px;font-size: 13px; ">Hết hàng</label>
                                            @endif
                                            <label style="position: absolute; margin-top: 76%;color: #660000;background-color: #CCFF00;padding: 2px 6px;border-radius: 11px;font-size: 13px; ">Trả góp 0%</label>

                                            <img src="{{ pare_url_file($product->pro_avatar) }}" class="img-fluid" width="100%" style="margin: 10px;height: 200px">
                                            <div class="info-item card-block" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden">
                                                <span class="card-title text-xl-center" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden"> {{ $product->pro_name }}</span><br>
                                                <b class="price">{{ fomatpricesale($product->pro_price ,$product->pro_sale) }}</b><br>
                                                <span class="sale"><strike class="card-text">{{ number_format($product->pro_price,0,',','.')  }}</strike><br><b style="color: red">(-{{ $product->pro_sale }}%)</b></span>
                                            </div>
                                        </a>
                                    </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <div class=" pull-right">{!!  $products->appends($query)->links()  !!}</div>
               </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            $('.orderby').change(function () {
                $('#form_order').submit();
            })
        })
    </script>

@stop
