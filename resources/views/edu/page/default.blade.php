@extends(THEME_NP.'.layouts.app')

@section('keywords'){!! $page->getKeywords() !!}@endsection
@section('description'){!! $page->getDescription() !!}@endsection
@section('title'){!! $page->title !!}@endsection

@section('content')
    <div class="container">
        @include(THEME_NP.'.layouts.particals.header')
        @widget('navigation_bar')
        <div class="list_page">
            <div class="left_sidebar">
                @widget('navigation_bar',['view' => 'side_nav'])
                @include(THEME_NP.'layouts.particals.search')
            </div>
            <div class="right_list">
                <div class="header">
                    {!! Breadcrumbs::render('category', $category) !!}
                </div>
                <div class="right_main">
                    <div class="title_container">
                        <h1>{!! $page->title !!}</h1>
                        <p class="info">
                            <span>{!! $page->published_at->format('Y年m月d日')!!}</span>
                            <span>{!! $page->views_count !!} 人阅读</span>
                            <span class="avatar">
                    上传：<span class="uname">{!! isset($page->user->nick_name)?$page->user->nick_name:$page->user->user_name !!}</span>
                </span>
                        </p>
                    </div>
                    <div class="content">
                        {!! $page->postContent->content !!}
                    </div>
                </div>
            </div>
        </div>
        @include(THEME_NP.'.layouts.particals.footer')
    </div>
@endsection

