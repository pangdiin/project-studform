<?php

return [
    'can_add' => false,
    'can_delete' => false,
    'position' => [
        // 'top-right' => 'Top Right', 
        // 'top-left' => 'Top Left',
        'top-center'    => 'Top Center', 
        // 'center-right' => 'Center Right', 
        // 'center-left' => 'Center Left',
        'bottom-right'  => 'Bottom Right', 
        'bottom-left'   => 'Bottom Left',
        'bottom-center' => 'Bottom Center'
    ],
	'menus' => [
        'tag'   => [
            'class'     => \App\Models\Tag::class,
            'url'       => 'frontend.page.node.show',
            'fields'    => ['id', 'name', 'slug', 'type'],
        ],
        'page'   => [
            'class'     => \App\Models\Page::class,
            'url'       => 'frontend.page.show',
            'fields'    => ['id', 'name', 'slug', 'status'],
        ],

        'product'   => [
            'class'     => \App\Models\Product\Product::class,
            'url'       => 'frontend.product.show',
            'fields'    => ['id', 'name', 'slug', 'brand_id'],
        ],

        // 'view'   => [
        //     'class'     => \App\Models\View\View::class,
        //     'url'       => 'frontend.page.show',
        //     'fields'    => ['id', 'name', 'slug'],
        // ],
        // 'page'   => [
        //     'class'     => \App\Models\Product::class,
        //     'url'       => 'frontend.page.show',
        //     'fields'    => ['id', 'title', 'slug'],
        // ],
    ],
];