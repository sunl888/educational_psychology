<?php
return [
    // 用户的默认密码
    'default_user_password' => 'test1234',

    'max_per_page' => 40,
    'default_per_page' => 15,

    'default_slug_mode' => 'pinyin',


    // todo 模板可以加一个主题  'current_theme' => 'test'
    'templates' => [
        'page_templates' => [
            [
                'file_name' => 'page.default',
                'title' => '默认单页模板'
            ]
        ]
        ,
        'list_templates' => [
            [
                'file_name' => 'list.default',
                'title' => '默认列表模板',
            ]
        ],
        'content_templates' => [
            [
                'file_name' => 'content.default',
                'title' => '默认正文模板',
            ]
        ]
    ],

    'logo' => env('LOGO', 'tiny'),

    // todo 这个配置可以拆出去
    'alert' => [
        'default_type' => 'info',
        'default_has_button' => false,
        'default_need_container' => true,
        'allow_type_list' => [
            'info', 'success', 'warning', 'danger'
        ]
    ],

    // 阅读间隔，每个用户在此时间内重复刷新文章页面只增长 1 个阅读量，单位分钟
    'reading_interval' => 1
];
