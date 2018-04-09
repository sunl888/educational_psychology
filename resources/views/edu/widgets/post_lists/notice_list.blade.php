<div class="right">
    <div class="title">
        <img src="{{cdn('edu/images/notice.png')}}" alt="">
        <h2>学术前沿</h2>
        <a class="more" {!! $category->getPresenter()->linkAttribute() !!}>更多</a>
    </div>
    <ul class="notice_list">
        @forelse($posts as $post)
            <li>
                <div class="date">
                    <p class="year">{!! $post->published_at->format('Y')!!}</p>
                    <p class="m_d">{!! $post->published_at->format('m/d')!!}</p>
                </div>
                <a href="{!! $post->getPresenter()->url() !!}">{!! $post->title !!}</a>
            </li>
        @empty
            <p class="no_data"><img src="{{cdn('edu/images/no_data.png')}}" alt=""></p>
        @endforelse
    </ul>
    {{--资料下载--}}
    @widget('post_list', ['category' => '资料下载', 'view' => 'post_lists.download', 'limit' => 1])
</div>