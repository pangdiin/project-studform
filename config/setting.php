<?php

return [

	'account' => [
		'name'	 		=> 'Site Information',
		'description' 	=> "Set the website's email, address, telephone, etc..",
		'cache'			=> false,
		'data' => [
			'email' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-envelope',
				'field' 	=> 'email',
				'display' 	=> 'E-mail Address',
				'value'	 	=> 'ronald.halcyondigital@gmail.com',
			],
			'address' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-map-marker',
				'field' 	=> 'text',
				'display' 	=> 'Address',
				'value'	 	=> 'Australia',
			],
	
			'telephone' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-phone',
				'field' 	=> 'text',
				'display' 	=> 'Telephone',
				'value'	 	=> '1800 352 366 1',
			],
	
			'mobile' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-mobile',
				'field' 	=> 'text',
				'display' 	=> 'Mobile Phone',
				'value'	 	=> '912312312',
			],
		]
	],

	'social' => [
		'name'	 		=> 'Social Links',
		'description' 	=> "Update your social links...",
		'cache'			=> true,
		'data' => [
			'fb' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-fb',
				'field' 	=> 'text',
				'display' 	=> 'Facebook Link',
				'value'	 	=> 'https://www.facebook.com/',
			],
			'twitter' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-twitter',
				'field' 	=> 'text',
				'display' 	=> 'Twitter Link',
				'value'	 	=> 'https://www.twitter.com/',
			],
			'instagram' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-instagram',
				'field' 	=> 'text',
				'display' 	=> 'Instagram Link',
				'value'	 	=> 'https://www.instagram.com/',
			],
		]
	],


	'mailchimp' => [
		'name'	 		=> 'Mailchimp API',
		'description' 	=> "Configure Mailchimp Newsletter...",
		'cache'			=> false,
		'data' => [
			'mailchimp-api-key' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-key',
				'field' 	=> 'text',
				'display' 	=> 'API Key',
				'value'	 	=> '321c380b00b6adf2de89098adad75dc9-us16',
			],

			'mailchimp-list-id' => [
				'group' 	=> 1,
				'icon'		=> 'fa fa-list',
				'field' 	=> 'text',
				'display' 	=> 'List ID',
				'value'	 	=> 'defc9411e7',
			],
		]
	],

];