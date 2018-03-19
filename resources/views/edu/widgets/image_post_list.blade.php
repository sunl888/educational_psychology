<div class="img_news">
    @forelse($image_posts as $post)
        <a href="{!! $post->getPresenter()->url() !!}">
            <img src="{!! image_url($post->cover) !!}" alt="">
            <div class="info">
                <h2>{!! $post->title !!}</h2>
                <p>{!! $post->excerpt !!}</p>
            </div>
        </a>
    @empty
        <p class="no_data">暂无数据</p>
    @endforelse

</div>