<div class="right_main">
    <ul class="text_list">
        @forelse($posts as $post)
            <li>
                <a href="{!! $post->getPresenter()->url() !!}" title="{!! $post->title !!}">{!! $post->title !!}</a>
                <span>{!! $post->published_at->format('Y-m-d')!!}</span>
            </li>
        @empty
            <p class="no_data"><img src="{{cdn('edu/images/no_data.png')}}" alt=""></p>
        @endforelse
    </ul>
    <!-- 分页 -->
    <div class="page_body">
        {!! $posts->fragment('list')->links('vendor.pagination.default') !!}
    </div>
</div>