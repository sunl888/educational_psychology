<div class="widget">
    <h4>站内搜索</h4>
    <div class="search">
        <form action="{{route('frontend.web.search')}}" method="GET">
            <input name="keywords" type="text" placeholder="输入想搜索的内容">
            <img class="btn" onclick="this.parentElement.submit()" src="{!! cdn('edu/images/search.png') !!}" alt="">
        </form>
    </div>
</div>