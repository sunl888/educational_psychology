<div class="widget">
    <h4>热门文章</h4>
    <ul class="content">
        @forelse($posts as $post)
            <li><a href="{!! $post->getPresenter()->url() !!}">{!! $post->title !!}</a></li>
        @empty
            <p class="no_data"><img src="{{cdn('edu/images/no_data.png')}}" alt=""></p>
        @endforelse
    </ul>
</div>