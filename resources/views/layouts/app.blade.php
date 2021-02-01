<!DOCTYPE html>
<html lang="en">
<head>
    <title> LAP LAP </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icon_loading.css') }}" />
</head>

@include('components.header')
<section>
        @yield('content')
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" title="Click to lên đầu trang" data-toggle="tooltip" data-placement="left">
        <i class="fa fa-angle-double-up"></i></a>

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
</section>
@include('components.footer')
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
        $(function(){
            $(".tragop").click(function (event) {
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                $("#myModalOrder").modal('show');
                $.ajax({
                    url: url,
                }).done(function (result) {
                    if(result)
                    {
                        $("#md_content").html('').append(result);
                    }
                    // console.log(result);
                });
            });
        })
</script>
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });
</script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
@yield('script')
