<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['assets_version'] = "0.0.1";


$config['assets_libs'] = [
	'bootstrap'=> [
		'version' => "4.1.3",
		'root_path'=> "assets/libs/bootstrap-4.1.3-dist/",
		'files' => [
			'css' => [
				'css/bootstrap.min',
				'css/bootstrap-grid.min',
				'css/bootstrap-reboot.min',
			],
			'js' => [
				'js/bootstrap.min',
			]
		],
	],
	'font_awesome'=> [
		'version' => "4.1.3",
		'root_path'=> "assets/libs/font-awesome-4.7.0/",
		'files' => [
			'css' => [
				'css/font-awesome.min',
			],
			'js' => []
		],
	],
	'j_confirm'=> [
		'version' => "3.3.0",
		'root_path'=> "assets/libs/jquery-confirm-v3.3.0/jquery-confirm-master/",
		'files' => [
			'css' => [
				'dist/jquery-confirm.min',
			],
			'js' => [
				'dist/jquery-confirm.min',
			]
		],
	],
	'j_query_ui'=> [
		'version' => "1.12.1",
		'root_path'=> "assets/libs/jquery-ui-1.12.1/",
		'files' => [
			'css' => [
				'jquery-ui.min',
			],
			'js' => [
				'dist/jquery-ui.min',
			]
		],
	],
	'j_query'=> [
		'version' => "3.3.1",
		'root_path'=> "assets/libs/jquery-v3.3.1/",
		'files' => [
			'js' => [
				'jQuery-v3.3.1.min',
			]
		],
	],

];