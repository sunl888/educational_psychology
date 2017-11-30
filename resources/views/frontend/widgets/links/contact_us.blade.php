@foreach($links as $link)
    <a href="{!! $link->url !!}" title="{!! $link->name !!}" target="_blank"><img
                lazy src="{!! image_url($link->logo, 'avatar_xs') !!}"
                alt="{!! $link->name !!}"><span>{!! $link->name !!}</span></a>
@endforeach