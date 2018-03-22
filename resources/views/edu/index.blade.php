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
            {{--新闻通告--}}
            @widget('post_list', ['category' => '新闻通告', 'view' => 'post_lists.news_list', 'limit' => 7])
            {{--科学研究--}}
            @widget('post_list', ['category' => '科学研究', 'view' => 'post_lists.notice_list', 'limit' => 4])
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
                var left = $picContainer.css('left');
                var currentLeft = parseInt(left.substring(0, left.length - 2));
                $picContainer.css('left', currentLeft - 1);
                if (currentLeft <= -200) {
                    $picContainer.css('left', 0);
                    $picContainer.append($picContainer.find('li').first());
                }
            }

            productTimer = setInterval(move, 20);

            $picContainer.hover(function () {
                clearInterval(productTimer);
            }, function () {
                productTimer = setInterval(move, 20)
            })
        }())
    </script>
@endpush