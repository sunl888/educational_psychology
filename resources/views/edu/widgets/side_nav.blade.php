<div class="widget">
    <h4 @if($navigation->getActiveNav()->is($navigation->getActiveTopNav()))class="active"@endif>
        {!! $navigation->getActiveTopNav()->cate_name !!}</h4>
    <ul class="content">
        @foreach($navigation->getActiveChildrenNav() as $childNav)
            <li @if($childNav->equals($navigation->getActiveNav()))class="active"@endif>
                <a title="{!! $childNav->cate_name !!}" {!! $childNav->getPresenter()->linkAttribute() !!}>{!! $childNav->cate_name !!}</a>
            </li>
        @endforeach
    </ul>
</div>