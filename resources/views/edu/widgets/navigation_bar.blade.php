<div class="header_nav">
    <ul>
        <li>
            <a {!! is_null($navigation->getActiveTopNav())?' class="active"':'' !!} href="{!! route('frontend.web.index')!!}">首页</a>
        </li>
        @foreach($allNav as $category)
            <li>
                <a title="{!! $category->cate_name !!}" {!! $category->is($navigation->getActiveTopNav())?' class="active"':'' !!} {!! $category->getPresenter()->linkAttribute() !!}>{!! $category->cate_name !!}</a>
            </li>
        @endforeach
    </ul>
</div>