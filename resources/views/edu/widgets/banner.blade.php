<div class="pic_roll">
    <div class="title">
        <img src="{{cdn('edu/images/pic.png')}}" alt="">
        <h2>学术队伍</h2>
    </div>
    <div class="pic_main">
        <ul class="pic_list">
            @php
                // 当banner小于6个时前端轮播图会出现问题，因此在这里手动复制一个banner
                $count = $banners->count();
                if($count < 6){
                    for ($i = 1; $i <= 6-$count; $i++) {
                        $banners->push($banners[$i-1]);
                    }
                }
            @endphp
            @foreach($banners as $banner)
                <li>
                    <a href="{!! $banner->url !!}">
                        <img src="{!! image_url($banner->image) !!}" alt="">
                        <p>{{ $banner->title or '' }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>