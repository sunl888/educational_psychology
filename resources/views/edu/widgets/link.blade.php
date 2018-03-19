<ul class="left_nav">
    @foreach($links as $link)
        <li><a href="{!! $link->url !!}" title="{!! $link->name !!}" target="_blank">{!! $link->name !!}</a></li>
    @endforeach
</ul>