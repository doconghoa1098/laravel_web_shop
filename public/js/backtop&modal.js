//function nút lên đầu trang
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
//function modal trả góp
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
    });
