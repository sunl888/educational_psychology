@extends(THEME_NP.'.layouts.app')

@section('keywords'){!! $keywords !!}@endsection
@section('description'){!! $keywords !!}@endsection
@section('title'){{ Breadcrumbs::pageTitle(' - ', 'search', $keywords) }}@endsection

@section('content')
    <div class="container">
        <!-- 头部 -->
    @include(THEME_NP.'.layouts.particals.header')
    <!-- 导航栏 -->
        @widget('navigation_bar')
        <!-- 中间部分 -->
        <div class="list_page">
            <div class="left_sidebar">
                @widget('hot_post_list')
                @include(THEME_NP.'layouts.particals.search')
            </div>
            <div class="right_list">
                <div class="header">
                    {{ Breadcrumbs::view(THEME_NP.'.layouts.particals.search_breadcrumbs', 'search', $keywords) }}
                </div>
                <div class="right_main">
                    <ul class="text_list">
                        @forelse($posts as $post)
                            <li>
                                <a href="{!! $post->getPresenter()->url() !!}"
                                   title="{!! $post->title !!}">{!! sign_color($post->title, $keywords) !!}</a>
                                <span class="time">{!! $post->published_at->format('Y-m-d')!!}</span>
                            </li>
                        @empty
                            <p class="no_data"><img src="{{cdn('edu/images/no_data.png')}}" alt=""></p>
                        @endforelse
                    </ul>
                    <!-- 分页 -->
                    <div class="page_body">
                        {!! $posts->fragment('list')->appends('keywords', $keywords)->links('vendor.pagination.default') !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- 底部导航 -->
        @include(THEME_NP.'.layouts.particals.footer')
    </div>

@endsection