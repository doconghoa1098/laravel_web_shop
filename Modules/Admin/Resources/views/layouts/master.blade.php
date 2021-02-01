<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
                    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta content="" name="description">
        <meta content="" name="author">
        <link href="../../favicon.ico" rel="icon">
        <link href="https://getbootstrap.com/docs/3.3/examples/dashboard/" rel="canonical">
        <title>Trang Quản Trị</title>
                                    <!-- Bootstrap core CSS -->
        <link href="{{ asset('theme_admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('theme_admin/css/dashboard.css')}}" rel="stylesheet">
        <link href="{{asset('theme_admin/css/font-awesome.min.css')}}" rel="stylesheet">
        <link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" rel="stylesheet">
        <link href="{{ asset('theme_admin/css/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/icon_loading.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        {{-- <script type="text/javascript">
            var baseURL = "{{ url('/') }}";
            alert(baseURL);
        </script> --}}
        {{--<script src="{{ asset('ckeditor/function.js') }}">--}}
{{--        <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>--}}
{{--        <script>tinymce.init({selector:'textarea'});</script>--}}

    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                        <span class="sr-only">
                            Toggle navigation
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <b style="color: #00AA00">
                            Xin chào: {{ get_data_user('admins','name') }}
                        </b>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-fw fa-gear"></i> Settings
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('admin.update.password')}}"><i class="fas fa-unlock-alt"></i> Đổi mật khẩu</a></li>
                                        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                                    </ul>
                                </a>
                            </li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="{{ \Request::route()->getName() == 'admin.home' ? 'active' : '' }}">
                            <a href="{{ route('admin.home') }}">
                                Trang Tổng Quan
                                <span class="sr-only">
                                    (current)
                                </span>
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.member' ? 'active' : '' }}">
                            <a href=" {{ route('admin.get.list.member') }}">
                                Thành viên
                            </a>
                        </li>

                        <li class="{{ \Request::route()->getName() == 'admin.get.list.category' ? 'active' : '' }}">
                            <a href=" {{ route('admin.get.list.category') }}">
                                Danh Mục
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.product' ? 'active' : '' }}">
                            <a href=" {{ route('admin.get.list.product') }}">
                                Sản Phẩm
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.rating' ? 'active' : '' }}">
                            <a href="{{route('admin.get.list.rating')}}">
                                Đánh giá
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.transaction' ? 'active' : '' }}">
                            <a href="{{route('admin.get.list.transaction')}}">
                                Đơn Hàng
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.user' ? 'active' : '' }}">
                            <a href="{{route('admin.get.list.user')}}">
                                Khách hàng
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.article' ? 'active' : '' }}">
                            <a href="{{ route('admin.get.list.article') }}">
                                Tin Tức
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.repay' ? 'active' : '' }}">
                            <a href="{{ route('admin.get.list.repay') }}">
                                Trả góp
                            </a>
                        </li>
                        <li class="{{ \Request::route()->getName() == 'admin.get.list.slide' ? 'active' : '' }}">
                            <a href="{{ route('admin.get.list.slide') }}">
                                Slide Web
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                    <a class="btn btn-primary back-to-top" data-placement="left" data-toggle="tooltip" href="#" id="back-to-top" role="button" title="Click to lên đầu trang">
                        <i class="fa fa-angle-double-up">
                        </i>
                    </a>
                    <div class="loader-wrapper">
                        <span class="loader">
                            <span class="loader-inner">
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
        </script>
        <script>
            $(document).ready(function(){
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-to-top').click(function () {
                    $('#back-to-top').tooltip('hide');
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });

                $('#back-to-top').tooltip('show');

            });
        </script>
        <script>
            $(window).on("load",function(){
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
        <script src="{{ asset('theme_admin/js/toastr.min.js') }}">
        </script>
        {!! Toastr::message() !!}
        <script>
            window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
        </script>
        <script src="{{asset('theme_admin/js/bootstrap.min.js')}}">
        </script>
        <script>
            function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#out_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#input_img").change(function() {
            readURL(this);
        });
        </script>
        @yield('script')
    </body>
</html>
