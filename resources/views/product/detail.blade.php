@extends('layouts.app')
@section('content')
    @include('components.slide')
    <style>
        .list_star i:hover{
            cursor: pointer;
        }
        .list_text{
            display: inline-block;
            margin-left: 10px;
            position: relative;
            background: #52b858;
            color: #fff;
            padding: 2px 8px;
            box-sizing: border-box;
            font-size: 12px;
            border-radius: 2px;
            display: none;
        }
        .list_star .rating_active, .pro-rating .active{
            color: #ff9705;
        }

        /*.list_text:after*/
        /*{*/
        /*    right: 100px;*/
        /*    top: 50%;*/
        /*    border: solid transparent;*/
        /*    content: " ";*/
        /*    height: 20px;*/
        /*    width: 0;*/
        /*    position: absolute;*/
        /*    pointer-events: none;*/
        /*    border-color: rgba(82,184,88,0);*/
        /*    border-right-color: #52b858;*/
        /*    border-width: 6px;*/
        /*    margin-top: -6px;*/
        /*}*/


    </style>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 ">
            </div>
            <div class="col-sm-8 text-left ">
                <div class="container ">
                    <div class="tensp">
                        <h4> {{$productDetail->pro_name}}</h4>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="text-center" >
                                <img src="{{ pare_url_file($productDetail->pro_avatar) }}" class="img-fluid"  width="300px" height="300px" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p > <label style="color: #003366; font-size: 1em;"><strike class="card-text">Giá niêm yết: {{ fomatprice($productDetail->pro_price) }} </strike></label>
                                <b><label style="color: white;background-color: red;border-radius: 8px;">   -{{$productDetail->pro_sale}} % </label></b>
                                <b style="color: #660000;background-color: #CCFF00;border-radius: 8px;"> Trả góp 0%</b><br>
                                <label style="color: #00AA00;">Giá bán: {{ fomatpricesale($productDetail->pro_price ,$productDetail->pro_sale)  }} </label><br>
                            </p>
                            <div class="camket">
                                <ul>
                                    <li>
                                        <i class="fas fa-medal"></i>
                                        <label>Hàng chính hãng</label>
                                    </li>
                                    <li>
                                        <i class="fas fa-shield-alt"></i>
                                        <label>Bảo hàng 24 tháng</label>
                                    </li>
                                    <li>
                                        <i class="fas fa-car-side"></i>
                                        <label>Giao hàng miễn phí toàn quốc </label>
                                    </li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <label>Bảo hành nhanh tại Shop trên toàn quốc</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                    <label style="color: #00AA00; margin-top: 1px;margin-left: 14px">Số lượng :</label>
                                    <input type="number"  value="1" id="qty" min="1" max="{{$productDetail->pro_number}}" style="width: 70px;margin-left: 10px;height: 23px;" class="form-control qty">(Còn {{$productDetail->pro_number}} sản phẩm)
                            </div>
                            @if($productDetail->pro_number > 0)
                            <div class="btn mua ">
                                <button class="btn btn-danger btn-block muahang" id="{{$productDetail->id}}">
{{--                                    <a href="{{route('add.shopping.cart',$productDetail->id) }}" >--}}
                                    <a href="#">
                                        <p class="m1">MUA NGAY</p>
                                        <span>Giao hàng tận nơi hoặc nhận tại shop</span>
                                    </a>
                                </button>
                                <p class="m2">Gọi 18001001 để được tư vấn mua hàng (miễn phí)</p>
                            </div>
                            @else
                            <div class="btn mua ">
                                <button class="btn btn-primary btn-block">
                                    <label>Tạm hết hàng</label>
                                    <br>Liên hệ để đặt hàng nhanh nhất
                                </button>
                                <p class="m2">Gọi 18001001 để được tư vấn mua hàng (miễn phí)</p>
                            </div>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin kĩ thuật</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Đánh giá & nhận xét</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Giới thiệu</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class=" anh col-sm-5" style="margin-top: 50px;">
                                        <img src="{{ pare_url_file($productDetail->pro_avatar) }} " alt="" class="img-fluid">
                                    </div>

                                    <div  style="height: 300px;overflow: auto;">{!! $productDetail->pro_content !!}</div><br>

                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="component_rating col-sm-12" style="margin-bottom: 20px">
                                        <hr>
                                        <?php
                                            $ageDetail = 0;
                                            if ($productDetail->pro_total_rating)
                                            {
                                                $ageDetail = round($productDetail->pro_total_number / $productDetail->pro_total_rating, 2);

                                            }
                                            ?>
                                       <b style="color: #0000cc">ĐÁNH GIÁ SẢN PHẨM</b>
                                        <div class="component_rating_content " style="display: flex;align-items: center;border-radius: 5px;border: 1px solid #dedede">
                                            <div class="rating_item" style="width: 20%;position: relative">
                                                <span class="fa fa-star" style="font-size: 80px;display: block ;color: #ff9705;margin: 0 auto;text-align: center"></span>
                                                <b style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);color: white;font-size: 20px">{{ $ageDetail }}</b>
                                            </div>
                                            <div class="list_rating" style="width: 60%;padding: 20px">
                                                @foreach($arrayRatings as $key => $arrayRating)
                                                    <?php $itemPoint = round( ($arrayRating['total'] /$productDetail->pro_total_rating) * 100,0 ); ?>
                                                    <div class="item_rating" style="display: flex;align-items:center">
                                                        <div style="width: 10%">
                                                            {{$key}} <span class="fa fa-star"></span>
                                                        </div>
                                                        <div style="width: 70%; margin: 0 20px ">
                                                            <span style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px;background-color: #dedede">
                                                                <b style="width: {{$itemPoint}}%;background-color: #f25800;display: block;border-radius: 5px;height: 100%"></b></span>
                                                        </div>
                                                        <div style="width: 30%">
                                                            <a href="#"> {{ $arrayRating['total'] }} đánh giá ({{$itemPoint}} %)</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div style="width: 20%">
                                                {{--                                    <a href="" class="js_rating_action " style="width: 200px;background: #288ad6;padding: 10px;color: white;border-radius: 5px" >Gửi đánh giá của bạn</a>--}}
                                            </div>
                                        </div>

                                        <div class="form_rating ">
                                            <div style="display: flex;margin-top: 15px;font-size: 15px" >
                                                <p>Đánh giá của bạn:</p>
                                                <span style="margin: 0 15px; " class="list_star">
                                                @for($i = 1; $i<=5; $i++)
                                                        <i class="fa fa-star" data-key="{{$i}}"></i>
                                                    @endfor
                                            </span>
                                                <span class="list_text" style="height: 20px;"></span>
                                                <input type="hidden" class="number_rating">
                                            </div>
                                            <div style="margin-top: 15px">
                                                <textarea name="" class="form-control"  id="ra_content" cols="30" rows="3"></textarea>
                                            </div>
                                            <div style="margin-top: 5px">
                                                <a href="{{ route('post.rating.product',$productDetail) }}" class="btn btn-primary js_rating_product" itemid="{{ get_data_user('web','active') }}">Gửi đánh giá</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="componet_list_rating" style="border: 1px solid #dedede;">
                                            @if(isset($ratings))
                                                @foreach($ratings as $rating)
                                                    <div class="rating_item" style="margin: 10px 0">
                                                        <div>
                                                        <span style="color:#0000cc;font-weight: bold;text-transform: capitalize;">
                                                            {{ isset($rating->user->name) ? $rating->user->name : '[N|A]' }}
                                                            <a href="" style="color: #2ba823"><i class="fa fa-check-circle "></i> Đã mua hàng tại website</a>
                                                        </span>
                                                        </div>
                                                        <p style="margin-bottom: 0">
                                                        <span class="pro-rating">
                                                             @for($i=1;$i<=5;$i++)
                                                                <i class="fa fa-star {{ $i <= $rating->ra_number ? 'active' : '' }}"></i>
                                                            @endfor
                                                        </span>
                                                         <span> {{$rating->ra_content}}</span>
                                                        </p>
                                                        <div>
                                                            <span><i class="fa fa-clock-o">{{ $rating->created_at }}</i></span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                    <p> {!! $productDetail->pro_description !!} </p><br>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8 text-left ">
                <div class="sanpham">
                    <div align="left">
                        <b class="title-main" style="color: #0000cc"> SẢN PHẨM TƯƠNG TỰ</b>
                    </div>
                @if(isset($productFollows))
                    @foreach($productFollows as $productFollow)
                        <div class="col-sm-3 item-product bor card  mt-1">
                            <a href="{{ route('get.detail.product',[$productFollow->pro_slug,$productFollow->id]) }}">
                                @if( $productFollow->pro_number == 0)
                                    <label style="position: absolute;margin-top: 7%;background: #e91e63;color: white;padding: 2px 6px;border-radius: 11px;font-size: 13px; ">Hết hàng</label>
                                @endif
                                <label style="position: absolute; margin-top: 76%;color: #660000;background-color: #CCFF00;padding: 2px 6px;border-radius: 11px;font-size: 13px; ">Trả góp 0%</label>

                                <img src="{{ pare_url_file($productFollow->pro_avatar) }}" class="img-fluid" width="100%" style="margin: 10px;height: 200px">
                                <div class="info-item card-block" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden">
                                    <span class="card-title text-xl-center" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden"> {{ $productFollow->pro_name }}</span><br>
                                    <b class="price">{{ fomatpricesale($productFollow->pro_price ,$productFollow->pro_sale) }}</b><br>
                                    <span class="sale"><strike class="card-text">{{ number_format($productFollow->pro_price,0,',','.')  }}</strike><br><b style="color: red">(-{{ $productFollow->pro_sale }}%)</b></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>
@stop
@section('script')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
           let listStar = $(".list_star .fa")
            listRatingText = {
                1 : 'Không thích',
                2 : 'Tạm được',
                3 : 'Bình thường',
                4 : 'Rất tốt',
                5 : 'Tuyệt vời'
             };
            listStar.mouseover( function () {
                let $this = $(this);
                let number = $this.attr('data-key');
                listStar.removeClass('rating_active');
                $(".number_rating").val(number);

                $.each(listStar, function (key,value) {
                    if( key+1 <= number)
                    {
                        $(this).addClass('rating_active')
                    }
                });

                $(".list_text").text('').text(listRatingText[$this.attr('data-key')]).show();

            });
            // $(".js_rating_action").click(function (event)  {
            //     event.preventDefault();
            //     if ($(".form_rating").hasClass('hide')
            //     {
            //         $(".form_rating").addClass('active').removeClass('hide')
            //     }else
            //     {
            //         $(".form_rating").addClass('hide').removeClass('active')
            //     }
            // });


            $(".js_rating_product").click(function(e) {
                e.preventDefault();
                let content = $("#ra_content").val();
                let number = $(".number_rating").val();
                let $this = $(this);
                let id = $this.attr('itemid');
                let url = $this.attr('href');
                if (id)
                {
                    if(number)
                    {
                        if (id!=4 && id!=0)
                        {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data : {
                                    number : number,
                                    r_content : content
                                },
                            }).done(function(result) {
                                if(result.code == 1)
                                {
                                   alert("Đánh giá thành công");
                                   location.reload();
                                }
                            });
                        }
                        if (id==4)
                        {
                            alert("Tài khoản của bạn bị khóa !");
                        }
                        if (id==0)
                        {
                            alert("Tài khoản của bạn chưa active !");
                        }
                    }
                    else
                    {
                        alert("Chưa chọn điểm đánh giá !");
                        // location.reload();
                    }

                }
                else
                {
                    alert("Chưa đăng nhập !");
                    // location.reload();
                }

            });
        });

        $(function () {
            $(".muahang").click(function (e) {
                e.preventDefault();
                $id = $(this).attr('id');
                $qty = $(this).parent().parent().find('#qty').val();
                $.ajax({
                    url: '/shopping/add/'+$id+'/'+$qty,
                    type: 'GET',
                    data : {'id': $id, 'qty' : $qty},
                    success:function (result) {
                        if(result.code == 1)
                        {
                            alert('Thêm vào giỏ hàng thành công');
                            location.reload();
                        }
                        if(result.code == 2)
                        {
                            alert('Số lượng sản phẩm trong kho không đủ.\n Vui lòng liên hệ admin để đặt hàng!!!');
                            location.reload();
                        }
                    }
                });

            });
        });
    </script>
@stop


