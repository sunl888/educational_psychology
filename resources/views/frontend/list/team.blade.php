@extends('frontend.layouts.default')
@section('content')
    @include('frontend.layouts.particals.navigation_bar', ['normalPage'=>true])
    <div class="container zm-team team-list">
        <div class="col">
        @foreach($posts as $post)
            <div class="team-item">
                <div class="team-main">
                    <div class="avatar">
                        <img src="{!! image_url($post->cover, 'avatar_md') !!}">
                    </div>
                    <h4>{!! $post->title !!}</h4>
                    <div class="tags">
                        @foreach($post->tags as $tag)
                            <span class="tag">{!! $tag->name !!}</span>
                        @endforeach
                    </div>
                    <p class="info">{!! $post->excerpt !!}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection