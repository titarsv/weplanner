<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    /**
     *  Размеры изображений
     */
    'sizes' => [
        'product_list' => [
            'description' => 'Размер изображения товара в категории',
            'width' => 165,
            'height' => 150
        ],
        'product' => [
            'description' => 'Размер главного изображения в карточке товара',
            'width' => 260,
            'height' => 260
        ],
        'product_thumb' => [
            'description' => 'Изображения-ссылки для галереи товара',
            'width' => 100,
            'height' => 100
        ],
        'article' => [
            'description' => 'Размер изображения блога',
            'width' => 410,
            'height' => 210
        ],
        'slide' => [
            'description' => 'Размер изображения слайда',
            'width' => 848,
            'height' => 367
        ],
        'banner' => [
            'description' => 'Размер изображения слайда',
            'width' => 262,
            'height' => 495
        ],
        'unit' => [
            'description' => 'Размер изображения слайда',
            'width' => 850,
            'height' => 650
        ],
        'action' => [
            'description' => 'Размер изображения слайда',
            'width' => 360,
            'height' => 200
        ]
    ],

    /**
     *  Типы изображений
     */
    'types' => [
        'default' => [
            'description' => 'Тип по умолчанию',
        ],
        'product' => [
            'description' => 'Изображение для продукта',
            'sizes' => [
                'product',
                'product_list',
                'product_thumb'
            ]
        ],
        'news' => [
            'description' => 'Изображение для постов',
            'sizes' => [
                'news'
            ]
        ],
        'slide' => [
            'description' => 'Изображение для слайда',
            'sizes' => [
                'slide'
            ]
        ],
        'banner'  => [
            'description' => 'Изображение узла',
            'sizes' => [
                'banner'
            ]
        ],
        'unit'  => [
            'description' => 'Изображение узла',
            'sizes' => [
                'unit'
            ]
        ],
        'action'  => [
            'description' => 'Изображение узла',
            'sizes' => [
                'action'
            ]
        ]
    ]

);
