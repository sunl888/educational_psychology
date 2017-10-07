@extends('frontend.layouts.default')

@section('content')
    <nav class="nav" id="nav">
        <div class="container">
            <div class="logo">
                <a href="{!! route('frontend.web.index') !!}">xx科技</a>
            </div>
            <ul class="menu">
                <li><a href="{!! route('frontend.web.index') !!}">首页</a></li>
                <li><a href="#case">案例</a></li>
                <li><a href="#news">新闻</a></li>
                <li><a href="#team">团队</a></li>
                <li><a href="#skill">技术栈</a></li>
                <li><a href="#contact">联系我们</a></li>
                <li><a href="#join">加入我们</a></li>
            </ul>
        </div>
        <div class="mask"></div>
    </nav>
    <header class="big-pic" id="big-pic">
        <div class="zm-txt">
            <div class="zm-work">
                Web Design - Web Development - UX Design
                <div class="line"></div>
            </div>
            <h2 class="zm-title">
                一群有趣的年轻人,<br/>
                追寻开发中的乐趣
            </h2>
        </div>
        <div class="mouse-icon">
            <div class="wheel"></div>
        </div>
    </header>
    <section class="zm-introduce zm-wrap">
        <div class="container">
            <header class="zm-title">
                <h3>xx科技</h3>
                <div class="line"></div>
                <p>创造不息，交付不止</p>
            </header>
            <p class="text">总部设立在北京，并在上海、广州、深圳、台湾、澳洲、天津、重庆等地区有 50 多位精英工程师，与产品和设计团队紧密配合，共同为客户创造优质的 WEB 应用和移动应用。</p>
        </div>
    </section>

    @php
        // $projectCaseCategory = app(\App\Repositories\CategoryRepository::class)->findBySlug();
    @endphp
    <section id="case" class="zm-case zm-wrap">
        <div class="container">
            <header class="zm-title">
                <h3>项目案例</h3>
                <div class="line"></div>
                <p>志存高远，护您远航</p>
            </header>
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 case-item">
                <div class="main">
                    <div class="img-wrap">
                        <img src="http://szimg.mukewang.com/59c9b245000143ae05400300-360-202.jpg">
                    </div>
                    <div class="body">
                        <h4>Tiny 强大简洁的CMS系统</h4>
                        <p>Tiny 是一个简单的 CMS, 基于 vue2.4 + laravel5.5 开发。你可以使用 Tiny 快速搭建自己的 cms 或者 blog。</p>
                        <div class="footer">
                            <span class="tag">PHP</span>
                            <span class="tag">Vue</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 case-item">
                <div class="main">
                    <div class="img-wrap">
                        <img src="http://szimg.mukewang.com/59c9b245000143ae05400300-360-202.jpg">
                    </div>
                    <div class="body">
                        <h4>Tiny 强大简洁的CMS系统</h4>
                        <p>Tiny 是一个简单的 CMS, 基于 vue2.4 + laravel5.5 开发。你可以使用 Tiny 快速搭建自己的 cms 或者 blog。</p>
                        <div class="footer">
                            <span class="tag">PHP</span>
                            <span class="tag">Vue</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 case-item">
                <div class="main">
                    <div class="img-wrap">
                        <img src="http://szimg.mukewang.com/59c9b245000143ae05400300-360-202.jpg">
                    </div>
                    <div class="body">
                        <h4>Tiny 强大简洁的CMS系统</h4>
                        <p>Tiny 是一个简单的 CMS, 基于 vue2.4 + laravel5.5 开发。你可以使用 Tiny 快速搭建自己的 cms 或者 blog。</p>
                        <div class="footer">
                            <span class="tag">PHP</span>
                            <span class="tag">Vue</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 case-item">
                <div class="main">
                    <div class="img-wrap">
                        <img src="http://szimg.mukewang.com/59c9b245000143ae05400300-360-202.jpg">
                    </div>
                    <div class="body">
                        <h4>Tiny 强大简洁的CMS系统</h4>
                        <p>Tiny 是一个简单的 CMS, 基于 vue2.4 + laravel5.5 开发。你可以使用 Tiny 快速搭建自己的 cms 或者 blog。</p>
                        <div class="footer">
                            <span class="tag">PHP</span>
                            <span class="tag">Vue</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="news" class="zm-news zm-wrap">
        <div class="container">
            <header class="zm-title">
                <h3>新闻中心</h3>
                <div class="line"></div>
                <p>news</p>
            </header>
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 news-item">
                <div class="news-main">
                    <a href="#" target="_blank">
                        <div class="img-wrap">
                            <img src="https://i1.hdslb.com/bfs/archive/475cb929447b2a533a88e0fc77777a9da910e023.jpg"
                                 alt="">
                        </div>
                    </a>
                    <a href="#" target="_blank" class="title">
                        <h4>上海市嘉定区抽检食用农产品20批样品全合格</h4>
                    </a>
                    <div class="line"></div>
                    <p>上海市嘉定区抽检食用农产品20批次样品全合格上海市嘉定区抽检食用农产品20批次样品全合格上海市嘉定区抽检食用农产品20批次样品全合格</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 news-item">
                <div class="news-main">
                    <a href="#" target="_blank">
                        <div class="img-wrap">
                            <img src="https://i1.hdslb.com/bfs/archive/475cb929447b2a533a88e0fc77777a9da910e023.jpg"
                                 alt="">
                        </div>
                    </a>
                    <a href="#" target="_blank" class="title">
                        <h4>上海市嘉定区抽检食用农产品20批样品全合格</h4>
                    </a>
                    <div class="line"></div>
                    <p>上海市嘉定区抽检食用农产品20批次样品全合格上海市嘉定区抽检食用农产品20批次样品全合格上海市嘉定区抽检食用农产品20批次样品全合格</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 news-item">
                <div class="news-main">
                    <a href="#" target="_blank">
                        <div class="img-wrap">
                            <img src="https://i1.hdslb.com/bfs/archive/475cb929447b2a533a88e0fc77777a9da910e023.jpg"
                                 alt="">
                        </div>
                    </a>
                    <a href="#" target="_blank" class="title">
                        <h4>上海市嘉定区抽检食用农产品20批样品全合格</h4>
                    </a>
                    <div class="line"></div>
                    <p>上海市嘉定区抽检食用农产品20批次样品全合格上海市嘉定区抽检食用农产品20批次样品全合格上海市嘉定区抽检食用农产品20批次样品全合格</p>
                </div>
            </div>
        </div>
        <div class="button_wrap">
            <a class="btn more_btn">查看更多<i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
    </section>

    <section id="team" class="zm-team zm-wrap">
        <div class="container">
            <header class="zm-title white">
                <h3>我们的团队</h3>
                <div class="line"></div>
                <p>年轻、热爱技术、享受技术</p>
            </header>
            <div id="teams">
                <div class="team-item">
                    <div class="team-main">
                        <div class="avatar">
                            <img src="https://avatars3.githubusercontent.com/u/15792482?v=4&s=460" alt="">
                        </div>
                        <h4>德莱文</h4>
                        <div class="tags">
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                        </div>
                        <p class="info">编程是不可能编程的，这辈子都不可能编程的。</p>
                    </div>
                </div>
                <div class="team-item">
                    <div class="team-main">
                        <div class="avatar">
                            <img src="https://avatars3.githubusercontent.com/u/15792482?v=4&s=460" alt="">
                        </div>
                        <h4>德莱文</h4>
                        <div class="tags">
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                        </div>
                        <p class="info">编程是不可能编程的，这辈子都不可能编程的。</p>
                    </div>
                </div>
                <div class="team-item">
                    <div class="team-main">
                        <div class="avatar">
                            <img src="https://avatars3.githubusercontent.com/u/15792482?v=4&s=460" alt="">
                        </div>
                        <h4>德莱文</h4>
                        <div class="tags">
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                        </div>
                        <p class="info">编程是不可能编程的，这辈子都不可能编程的。</p>
                    </div>
                </div>
                <div class="team-item">
                    <div class="team-main">
                        <div class="avatar">
                            <img src="https://avatars3.githubusercontent.com/u/15792482?v=4&s=460" alt="">
                        </div>
                        <h4>德莱文</h4>
                        <div class="tags">
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                        </div>
                        <p class="info">编程是不可能编程的，这辈子都不可能编程的。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="skill" class="zm-skill zm-wrap">
        <header class="zm-title">
            <h3>WE GOT SKILLS</h3>
        </header>
        <div class="container skills">
            @foreach(Facades\App\Widgets\Link::mergeConfig(['type'=>'skill'])->getData()['links'] as $link)
                <a href="{!! $link->url !!}" title="{!! $link->name !!}" target="_blank"><img
                            src="{!! image_url($link->logo) !!}" alt=""></a>
            @endforeach
        </div>
    </section>

    <section id="contact" class="zm-contact zm-wrap">
        <header class="zm-title">
            <h3>联系我们</h3>
            <div class="line"></div>
        </header>
        <div class="container">
            <p class="contact-item">邮箱：xxxxxx@qq.com</p>
            <p class="contact-item">电话：13900000000</p>
            <p class="contact-item">地址：喜喜喜喜喜喜喜喜喜喜</p>
            <div class="contact-link">
                <a href="#"><img src="https://gold-cdn.xitu.io/images/about/GitHub@2x.png"
                                 alt=""><span>Github</span></a>
                <a href="#"><img src="https://gold-cdn.xitu.io/images/about/GitHub@2x.png"
                                 alt=""><span>Github</span></a>
                <a href="#"><img src="https://gold-cdn.xitu.io/images/about/GitHub@2x.png"
                                 alt=""><span>Github</span></a>
                <a href="#"><img src="https://gold-cdn.xitu.io/images/about/GitHub@2x.png"
                                 alt=""><span>Github</span></a>
            </div>
        </div>
    </section>

    <section id="join">
        <div class="zm-join" id="particles-js">
            <div class="text">
                <h3>加入我们</h3>
                <p>如果你喜欢这样的我们，请发送简历到xxxx@qq.com</p>
            </div>
            <footer class="copy">xx科技 &copy; 2017</footer>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function () {
            var $bigPic = $('#big-pic');
            var $window = $(window);
            $window.resize(function () {
                $bigPic.height($(this).height());
            });
            $window.resize();
            var $nav = $('#nav');
            $window.scroll(function () {
                if ($window.scrollTop() > $bigPic.height()) {
                    $nav.addClass('small')
                } else {
                    $nav.removeClass('small')
                }
            });
        });
        $(function () {
            $teams = $('#teams');
            if ($teams.children().length == 0)
                return;
            $teams.slick({
                dots: true,
                infinite: true,
                centerMode: true,
                variableWidth: true,
                autoplay: true,
                autoplaySpeed: 5000,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: false
            });
        })
        $(function () {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "polygon",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 3,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": false
            });
        });
    </script>
@endsection