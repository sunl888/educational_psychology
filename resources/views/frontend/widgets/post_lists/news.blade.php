<section data-id="news" class="zm-news zm-wrap">
    <div class="container">
        <header class="zm-title">
            <h3>{!! $category->cate_name !!}</h3>
            <div class="line"></div>
            <p>{!! $category->description !!}</p>
        </header>
        @foreach($posts as $post)
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-6 news-item">
                <div class="news-main">
                    <a href="{!! $post->getPresenter()->url() !!}" target="_blank" title="{!! $post->title !!}">
                        <div class="img-wrap">
                            <img lazy src="{!! image_url($post->cover, ['w'=>350, 'h'=>230]) !!}">
                        </div>
                    </a>
                    <a href="{!! $post->getPresenter()->url() !!}" target="_blank" class="title"
                       title="{!! $post->title !!}">
                        <h4>{!! $post->getPresenter()->suitedTitle() !!}</h4>
                    </a>
                    <div class="line"></div>
                    <p>{!! $post->excerpt !!}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="button_wrap">
        <a class="btn more_btn"{!! $category->getPresenter()->linkAttribute() !!}>查看更多<i
                    class="glyphicon glyphicon-chevron-right"></i></a>
    </div>
</section>