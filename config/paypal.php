<?php

return [

	'client_id' => env('PAYPAL_CLIENT'),
	'secret_id' => env('PAYPAL_KEY'),
	'setting' => [
		'http.ConnectionTimeOut' => 30,
		'mode' => 'sandbox', // live
		'log.LogEnabled' => false,
        'log.FileName' => __DIR__.'/../PayPal.log',
        'log.LogLevel' => 'FINE'
	],
];