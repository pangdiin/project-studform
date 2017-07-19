<?php

return [

	/*
     |--------------------------------------------------------------------------
     | Date Format
     |--------------------------------------------------------------------------
     |
     | Used for formating all the dates in the site. Except on specified date format.
    */
	'date_format' => 'M d, Y h:i A',


	/*
     |--------------------------------------------------------------------------
     | Slide Options
     |--------------------------------------------------------------------------
     |
     | Defining carousel of the system. 
    */
	'slide' => [
        'active'        => true,
		'mutliple'		=> false,
		'title' 		=> true ,
		'description' 	=> true ,
		'max_width'		=> 1024 , 
		'max_height'	=> 600  ,
		'max_size'		=> '2MB'
	],

    'page' => [
        'can_add'   => true,
        'images'    => 5,
    ],
    'position' => [
        // 'top-right' => 'Top Right', 
        // 'top-left' => 'Top Left',
        // 'center-right' => 'Center Right', 
        // 'center-left' => 'Center Left',
        'bottom-right'  => 'Bottom Right', 
        'bottom-left'   => 'Bottom Left',
        'bottom-center' => 'Bottom Center'
    ],


    'view' => [
        'type' => [
            ''
        ],
        'template' => [

        ]

    ],

   
];