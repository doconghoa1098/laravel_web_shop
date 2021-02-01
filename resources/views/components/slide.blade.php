<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 "></div>
            <div class="col-sm-8 text-left ">   
                @if($slides)
                <div class="slide">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php $i=1 ?>
                                    @foreach($slides as $slide)
                                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{ $i == 1 ? 'active' : '' }}"></li>
                                     <?php $i++ ?>
                                     @endforeach
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <?php $i=1 ?>
                                    @foreach($slides as $slide)
                                        @if($slide->s_product_id)
                                            @foreach( (App\Models\Product::where('id',$slide->s_product_id)->get()) as $product)
                                                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                                    <a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}">
                                                        <img src="{{ pare_url_file($slide->s_avatar) }}" class="img-fluid">
                                                    </a>
                                                </div>
                                            @endforeach
                                         @else
                                                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                                    <a href="#">
                                                        <img src="{{ pare_url_file($slide->s_avatar) }}" class="img-fluid">
                                                    </a>
                                                </div>
                                        @endif
                                    <?php $i++ ?>
                                    @endforeach
                                </div>
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" >
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" >
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
         <div class="col-sm-2 "></div>
    </div>
</div>
