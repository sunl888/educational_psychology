<section data-id="case" class="zm-case zm-wrap">
    <div class="container">
        <header class="zm-title">
            <h3>{!! $category->cate_name !!}</h3>
            <div class="line"></div>
            <p>{!! $category->description !!}</p>
        </header>
        @foreach($posts as $post)
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-6 case-item">
                <div class="main">
                    <div class="img-wrap">
                        <img lazy src="{!! image_url($post->cover, 'case_cover') !!}">
                    </div>
                    <div class="body">
                        <h4>{!! $post->getPresenter()->suitedTitle() !!}</h4>
                        <p>{!! $post->excerpt !!}</p>
                        <div class="footer">
                            @foreach($post->tags as $tag)
                                <span class="tag">{!! $tag->name !!}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>