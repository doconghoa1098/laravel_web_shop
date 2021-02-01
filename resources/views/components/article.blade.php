@if(isset($articles))
    @foreach($articles as $article)
        <div class="article" style="padding: 5px 0;border-bottom: 1px solid #f2f2f2;display: flex">
            <div class="article_avatar">
                <a href="{{route('get.detail.article',[$article->a_slug,$article->id]) }}">
                    <img src="{{ pare_url_file($article->a_avatar) }}" style="width:150px;height:120px ">
                </a>
            </div>
            <div class="article_info" style="width: 80%;margin-left: 20px">
                <h4 style=""><a href="{{ route('get.detail.article',[$article->a_slug,$article->id]) }}">{{$article->a_name}}</a></h4>
                <p style="height: 50px">{{ $article->a_title_seo }}</p>
                <p><span style="color:red;font-weight: bold">ADMIN</span> <span>{{ $article->created_at }}</span></p>
            </div>
        </div>
        <hr>
    @endforeach
    <div class="pull-right">{!! $articles->links() !!} </div>
@endif
