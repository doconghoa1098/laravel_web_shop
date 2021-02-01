
<body style="background-color:WhiteSmoke">
    <div class="thanhtren">
        <div id="header">
            <div id="header-top">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-md-2 ">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('image/logo-1.png') }}" alt="">
                                    <h4 ><b>LAPLAP</b></h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="timkiem">
                                <form class="form-inline" action="{{route('get.product.list')}}" method="GET">
                                    <div >
                                        <input type="text" name="k" placeholder="Bạn cần tìm gì ?" class="form-control" size="40px;">
                                        <button class="btn btn-default" type="submit" name="search"><img src="{{asset('image/timkiem.png')}}" ></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <nav id="header-nav-top">
                                <ul class="list-inline pull-right" id="headermenu">
                                    @if (Auth::check())
                                    <li>
                                        <i> Xin chào:   <b>{{ get_data_user('web','name') }}</b> </i>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" id="navbarDropdown"> <i class="fa fa-user"></i> <b>Tài Khoản</b></a>
                                        <div class="dropdown-content text-center">
                                            @if(get_data_user('web','active')==0)
                                            <a class="dropdown-item" href="{{ route('get.active.account') }}"><span>ACTIVE ACCOUNT</span></a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('user.dashboard') }}"><span>Thông tin cá nhân</span></a>
{{--                                            <div class="dropdown-divider"></div>--}}
                                            <a class="dropdown-item" href="{{ route('get.list.shopping.cart') }}"><span>Giỏ hàng ({{ \Cart::count() }})</span></a>
{{--                                            <div class="dropdown-divider"></div>--}}
                                            <a class="dropdown-item" href="{{ route('get.logout.user') }}"><i class="fa fa-share"></i><span>Thoát</span></a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ route('get.list.shopping.cart') }}"><i class="fa fa-shopping-cart"></i> <b>({{ \Cart::count() }})</b></a>
                                    </li>
                                    @else
                                        <li>
                                            <a href="{{ route('get.login') }}" class="login"><i class="fa fa-unlock"></i> <b>Đăng nhập</b></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('get.register') }}"><i class="fa fa-user"></i> <b>Đăng ký</b></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('get.list.shopping.cart') }}"><i class="fa fa-shopping-cart"></i> <b>({{ \Cart::count() }})</b></a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class=" container">
            <nav class="navbar ">
                <ul>
                    <li>
                        <a href="{{ route('home') }}"><img src="{{ asset('image/homepage.png') }}">TRANG CHỦ</a>
                    </li>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('get.list.product',[$category->c_slug,$category->id]) }}" title="{{ $category->c_name }}">
                                    <img src="{{ pare_url_file($category->c_avatar) }}">
                                    {{ $category->c_name }}</a>
                            </li>
                        @endforeach
                    @endif
                    <li>
                        <a href="{{route('get.list.article')}}"><img src="{{asset('image/khuyenmai.jpg')}}" STYLE="width: 39px">TIN TỨC</a>
                    </li>
                    <li>
                        <a href="{{ route('get.list.repayment')}}" class="tragop"><img src="{{asset('image/tragop.png')}}" >TRẢ GÓP 0%</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

 <marquee direction="right"><b>WEB BÁN HÀNG CỦA NHÓM </b></marquee>


  <div class="modal fade" id="myModalOrder" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <b class="modal-title">THÔNG TIN TRẢ GÓP 0%</b>
                </div>
                <div class="modal-body" id="md_content">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
