@extends(THEME_NP.'.layouts.app')

@section('keywords'){!! $post->getKeywords() !!}@endsection
@section('description'){!! $post->getDescription() !!}@endsection
@section('title'){!! $post->title !!}@endsection

@section('content')
    <div class="container">
        @include(THEME_NP.'.layouts.particals.header')
        @widget('navigation_bar')
        <div class="list_page">
            <div class="left_sidebar">
                @widget('hot_post_list')
                @include(THEME_NP.'layouts.particals.search')
            </div>
            <div class="right_list">
                <div class="header">
                    {!! Breadcrumbs::render('post', $post) !!}
                </div>
                <div class="right_main">
                    <div class="title_container">
                        <h1>{!! $post->title !!}</h1>
                        <p class="info">
                            <span>{!! $post->published_at->format('Y年m月d日')!!}</span>
                            <span>{!! $post->views_count !!} 人阅读</span>
                            <span class="avatar">
                    上传：<span class="uname">{!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}</span>
                </span>
                        </p>
                    </div>
                    <div class="content">
                        {!! $post->postContent->content !!}
                    </div>
                    <div class="recommend">
                        <p>上一篇：<a href="{{$post->getPreviousPost()?$post->getPreviousPost()->getPresenter()->url():''}}">{{$post->getPreviousPost()?$post->getPreviousPost()->title:'没有了'}}</a></p>
                        <p>下一篇：<a href="{{$post->getNextPost()?$post->getNextPost()->getPresenter()->url():''}}">{{$post->getNextPost()?$post->getNextPost()->title:'没有了'}}</a></p>
                    </div>
                </div>
            </div>
        </div>
        @include(THEME_NP.'.layouts.particals.footer')
    </div>
@endsection

