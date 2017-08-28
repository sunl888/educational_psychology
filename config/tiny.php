<?php
return [
    // 用户的默认密码
    'default_user_password' => 'test1234',

    'max_per_page' => 40,
    'default_per_page' => 15,

    'templates' => [
        'page_templates' => [
            [
                'file_name' => 'post.page',
                'title' => '默认单页模板'
            ]
        ]
        ,
        'list_templates' => [
            [
                'file_name' => 'post.list',
                'title' => '默认列表模板',
            ]
        ],
        'content_templates' => [
            [
                'file_name' => 'post.content',
                'title' => '默认正文模板',
            ]
        ]
    ]
];