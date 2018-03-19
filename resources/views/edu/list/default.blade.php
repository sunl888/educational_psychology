@extends(THEME_NP.'.layouts.app')

@section('keywords'){!! $category->getKeywords() !!}@endsection
@section('description'){!! $category->getDescription() !!}@endsection
@section('title'){{ Breadcrumbs::pageTitle(' - ', 'category', $category) }}@endsection

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
                    {{ Breadcrumbs::render('category', $category) }}
                </div>
                @widget('post_list', ['category' => $category->cate_name, 'view' => 'post_lists.default_list', 'limit' => 7])
            </div>
        </div>
        <!-- 底部导航 -->
        @include(THEME_NP.'.layouts.particals.footer')
    </div>

@endsection