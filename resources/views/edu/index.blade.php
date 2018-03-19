@extends(THEME_NP.'.layouts.app')
@section('keywords'){{ setting('default_keywords') }}@endsection
@section('description'){{ setting('default_description') }}@endsection
@section('title'){{ setting('site_name') }}@endsection

@section('content')
    <div class="container">
        <!-- 头部 -->
        @include(THEME_NP.'.layouts.particals.header')
        <!-- 导航栏 -->
        @widget('navigation_bar')
        <!-- 中间内容 -->
        <div class="index_content">
            {{--新闻速递--}}
            @widget('post_list', ['category' => '新闻速递', 'view' => 'post_lists.news_list', 'limit' => 7])
            {{--通知通告--}}
            @widget('post_list', ['category' => '通知通告', 'view' => 'post_lists.notice_list', 'limit' => 4])
        </div>
        <!-- 图片滚动 -->
        @widget('banner', ['type'=>'categorys'])
        {{--footer start--}}
        @include(THEME_NP.'.layouts.particals.footer')
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(function () {
            // 图片滚动
            var $picContainer = $(".pic_list");
            var $imgList = $(".pic_list>li");
            var productTimer = null;
            $picContainer.width($imgList[0].offsetWidth * $imgList.length);

            function move() {
                var current = $picContainer.css("transform").replace(/[^0-9\-,]/g, '').split(',')[4] - 1;
                $picContainer.css("transform", "translateX(" + current + "px)");
                if (current <= -200) {
                    $picContainer.css("transform", "translateX(0px)");
                    $picContainer.append($picContainer.children().first());
                }
            }

            productTimer = setInterval(function () {
                move();
            }, 20);

            $picContainer.hover(function () {
                clearInterval(productTimer);
            }, function () {
                productTimer = setInterval(function () {
                    move();
                }, 20)
            })
        }())
    </script>
@endpush