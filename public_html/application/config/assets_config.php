<?php


$config['assets_version'] = '1.0';

$config['assets_libs'] = [
	'bootstrap'=> [
		'version' => "4.4.1",
		'root_path'=> "/assets/libs/bootstrap-4.4.1-dist/",
		'files' => [
			'css' => [
				'/css/bootstrap.min',
			],
			'js' => [
				'/js/bootstrap.min',
			]
		],
    ],
    'crypto_js' => [
        'version' => "3.1.2",
        "root_path"=> "/assets/libs/CryptoJS-v3.1.2/",
        "files" => [
            'css'=> [],
            'js' => []
        ]

    ],
	'font_awesome'=> [
		'version' => "5.13.0",
		'root_path'=> "/assets/libs/fontawesome-free-5.13.0-web/",
		'files' => [
			'css' => [
				'/css/all.min',
			],
			'js' => [
                '/js/all.min'
            ]
		],
	],
	'j_confirm'=> [
		'version' => "3.3.4",
		'root_path'=> "/assets/libs/jquery-confirm-v3.3.4/",
		'files' => [
			'css' => [
				'/dist/jquery-confirm.min',
			],
			'js' => [
				'/dist/jquery-confirm.min',
			]
		],
	],
	'j_query_ui'=> [
		'version' => "1.12.1",
		'root_path'=> "/assets/libs/jquery-ui-1.12.1/",
		'files' => [
			'css' => [
				'jquery-ui.min',
			],
			'js' => [
				'jquery-ui.min',
			]
		],
	],
	'j_query'=> [
		'version' => "3.5.0",
		'root_path'=> "/assets/libs/jQuery-v3.5.0/",
		'files' => [
			'js' => [
				'jQuery-v3.5.0.min',
			]
		],
	],
	'beautify_json'=>[
		'version'=> "0.0.0",
		'root_path'=> "/assets/libs/Beautify-json/",
		"files"=>[
			'js' => ['jquery.json-editor.min']
		]
	]
];