<div class="logo">
    <a href="{!! route('frontend.web.index') !!}">xx科技</a>
</div>
<ul class="menu">
    <li><a href="{!! route('frontend.web.index') !!}">首页</a></li>
    @foreach($allNav as $category)
        <li><a{!! $category->getPresenter()->linkAttribute() !!}>{!! $category->cate_name !!}</a></li>
    @endforeach
</ul>