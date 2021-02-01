@extends('admin::layouts.master')

@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>

    <h1 class="page-header">Tổng quan</h1>
<div class="row placeholders">
    <div class="col-xs-6 col-sm-3 placeholder" style="position: relative;">
        <img alt="Generic placeholder thumbnail" class="img-responsive" height="200" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200"><h4 style="position: absolute; top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0;color: whitesmoke">Doanh thu ngày {{fomatprice($moneyDay) }} VNĐ</h4></img>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder" style="position: relative;">
        <img alt="Generic placeholder thumbnail" class="img-responsive" height="200" src="{{ asset('image/tronhong.png') }}" width="200"><h4 style="position: absolute; top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0;color: whitesmoke" >
            <img src="{{asset('image/khuyenmai.jpg')}}" alt="" height="30px" style="margin-top:-13%"><br>  {{$transactionNews}} đơn hàng mới</h4></img>
        {{--            title="Tổng {{$transactions}} đơn hàng. {{$transactionFee}} đơn đang vận chuyển. {{$transactionSuccess}} đơn đã xử lý thành công"--}}

    </div>
    <div class="col-xs-6 col-sm-3 placeholder" style="position: relative;">
        <img alt="Generic placeholder thumbnail" class="img-responsive" height="200" src="{{ asset('image/tronxanhnhe.png') }}" width="200"><h4 style="position: absolute; top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0;color: whitesmoke">{{$products}} sản phẩm</h4></img>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder" style="position: relative;">
        <img alt="Generic placeholder thumbnail" class="img-responsive" height="200" src="{{ asset('image/red.png') }}" width="200"><h4 style="position: absolute; top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0;color: whitesmoke">{{$users}} thành viên</h4></img>
    </div>
</div>
<hr>
 <div class="col-sm-12">
    <h2 class="sub-header">Thống kê doanh thu</h2>
    <div class="table-responsive">
        <g class="highcharts-range-selector-group" transform="translate(0,54)">
            <form  action="" >
                <input type="date" name="date" class="btn btn-xs btn-default" value="{{ \Request::get('date')  ? \Request::get('date') : $day }}">
                <button type="submit" class="btn btn-xs btn-default" title="Thống kê"><i class="fa fa-search"></i></button>
            </form>
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        let data = "{{ $dataMoney }}";
        dataChart = JSON.parse(data.replace(/&quot;/g,'"'));

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Biểu đồ doanh thu '
            },
            subtitle: {
                // text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Mức độ'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y: 1f}.VNĐ'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y: 1f}.VNĐ</b><br/>'
            },

            series: [
                {
                    name: "Cửa hàng",
                    colorByPoint: true,
                    data: dataChart
                }
            ],
        });
    </script>
@endsection
