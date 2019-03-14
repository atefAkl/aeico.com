<?php

return [
	'template' => [
		'wrapper_start' 	=> TPL_PATH . 'wrapperstart.php',
		'header' 			=> TPL_PATH . 'header.php',
		'nav' 				=> TPL_PATH . 'nav.php',
		':view' 			=> ':action_view',
		'wrapper_end' 		=> TPL_PATH . 'wrapperend.php',
		'footer'			=> TPL_PATH . 'footer.php',
	],
	'header_resources' => [
		'css' => [
			'bootstrap' => CSS . 'bootstrap.min.css',
			'font-awesome' => CSS . 'font-awesome.min.css',
			'main' => CSS . 'style.css'
		],
		'js' => [],
	],
	'footer_resources' => [
		'js' => [
			'jq' => JS . 'jquery-3.1.1.min.js',
			'bs' => JS . 'bootstrap.min.js',
			'script' => JS . 'script.js'
		]
	]
];