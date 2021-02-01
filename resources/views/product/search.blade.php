@extends('layouts.app')
@section('content')
    @include('components.slide')
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 ">
            </div>
            <div class="col-sm-8 text-left ">
                @if(isset($products))
                    <h3>Sản phẩm tìm được</h3>
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
                    <div class=" pull-right">{!!  $products->appends($query)->links()  !!}</div>
            </div>
            <div class="col-sm-2 ">

            </div>
        </div>

    </div>
    </div>

@stop
