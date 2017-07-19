<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        realpath(base_path('resources/views')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),


    'content' => [
        'brand'     => [
            'model'     => App\Models\Tag::class,
            'where'     => ['type' => 1],
            'fields'    => [
                'name', 'slug', 'type', 'description'
            ],
        ],
        
        'block'     => [
            'model'     => App\Models\Block::class,
            'fields'    => [
                'name', 'slug', 'status', 'description', 'content'
            ]
        ],
        'page'     => [
            'model'     => App\Models\Page::class,
            'fields'    => [
                'name', 'slug', 'status', 'description', 'content'
            ],
            'path'  => [
                'admin' => 'admin.page.edit',
                'view'  => 'frontend.page.show'
            ]
        ],
        'product'     => [
            'model'     => App\Models\Product\Product::class,
            'with'      => ['brand', 'brochure', 'gallery'],
            'fields'    => [
                'name', 'slug', 'status', 'description', 'content', 
            ],
            'path'  => [
                'admin' => 'admin.product.edit',
                'view'  => 'frontend.product.show'
            ]
        ],
        'project'     => [
            'model'     => App\Models\Project\Project::class,
            'with'      => ['gallery'],
            'fields'    => [
                'name', 'slug', 'status', 'description', 'content', 
            ],
            'path'  => [
                'admin' => 'admin.project.edit',
                'view'  => 'frontend.project.show'
            ]
        ],
        // 'brochure'     => [
        //     'model'     => App\Models\Product\Brochure::class,
        //     'with'      => ['product'],
        //     'fields'    => [
        //         'product.name', 'product.slug', 'product.description', 'product.content', 
        //     ],
        // ],
        // 'gallery'     => [
        //     'model'     => App\Models\Gallery\Gallery::class,
        //     'with'      => ['product'],
        //     'fields'    => [
        //         'product.name', 'product.slug', 'product.description', 'product.content', 
        //     ],
        // ],
        // 'view'     => [
        //     'model'     => App\Models\View\View::class,
        //     'fields'    => [
        //         'name', 'slug', 'content', 
        //         'seo', 'description', 'meta',
        //         'type', 'status', 
        //     ],
        // ],

    ],
    'conditions' => [
        'like',
        '=',
        '!=',
        '>',
        '>=',
        '<',
        '<=',
        'in'
    ],
    'operation' => [
        'and', 'or'
    ],
    'template' => [
        'default'   => 'Default',
        'slick'     => 'Slick',
        'block'     => 'Block',
    ]
];
