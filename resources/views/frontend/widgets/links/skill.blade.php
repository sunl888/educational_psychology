@foreach($links as $link)
    <a href="{!! $link->url !!}" title="{!! $link->name !!}" target="_blank"><img
                lazy src="{!! image_url($link->logo, ['w'=>150]) !!}" alt="{!! $link->name !!}"></a>
@endforeach