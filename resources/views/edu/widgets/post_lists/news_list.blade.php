<div class="left">
    <div class="title">
        <img src="{{cdn('edu/images/news.png')}}" alt="新闻速递">
        <h2>新闻速递</h2>
        <a class="more" {!! $category->getPresenter()->linkAttribute() !!}>更多</a>
    </div>
    <div class="content">
        @widget('image_post', ['category' => '新闻速递'])
        <ul class="news_list">
            @forelse($posts as $post)
                <li>
                    <a href="{!! $post->getPresenter()->url() !!}">{!! $post->title !!}</a>
                    <span>{!! $post->published_at->format('Y-m-d')!!}</span>
                </li>
            @empty
                <p class="no_data">暂无数据</p>
            @endforelse
        </ul>
    </div>
</div>