<section data-id="team" class="zm-team zm-wrap">
    <div class="container">
        <header class="zm-title white">
            <h3>{!! $category->cate_name !!}</h3>
            <div class="line"></div>
            <p>{!! $category->description !!}</p>
        </header>
        <div id="teams">
            @foreach($posts as $post)
                <div class="team-item">
                    <div class="team-main">
                        <div class="avatar">
                            <img lazy src="{!! image_url($post->cover, 'avatar_md') !!}">
                        </div>
                        <h4>{!! $post->title !!}</h4>
                        <div class="tags">
                            @foreach($post->tags as $tag)
                                <span class="tag">{!! $tag->name !!}</span>
                            @endforeach
                        </div>
                        <p class="info">{!! $post->excerpt !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="button_wrap">
        <a class="btn more_btn"{!! $category->getPresenter()->linkAttribute() !!}>查看更多<i class="glyphicon glyphicon-chevron-right"></i></a>
    </div>
</section>
@push('js')
<script>
    $(function () {
        $teams = $('#teams');
        if ($teams.children().length == 0)
            return;
        $teams.slick({
            dots: true,
            infinite: true,
            centerMode: true,
            variableWidth: true,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: true
        });
    })
</script>
@endpush