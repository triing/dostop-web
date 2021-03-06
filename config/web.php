<?php

/* Include debug functions */
require_once(__DIR__.'/functions.php');

use \kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'sl', // slovenian
    'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableUnconfirmedLogin' => true,
			'enableRegistration' => false,
			'confirmWithin' => 21600,
			'cost' => 12,
			'admins' => ['admin', 'gams']
		],
		'redactor' => 'yii\redactor\RedactorModule',
		'datecontrol' =>  [
			'class' => 'kartik\datecontrol\Module',
	 
			// format settings for displaying each date attribute (ICU format example)
			'displaySettings' => [
				Module::FORMAT_DATE => 'php:j. n. Y',
				Module::FORMAT_TIME => 'php:G:i:s',
				Module::FORMAT_DATETIME => 'php:j. n. Y G:i:s', 
			],
			
			// format settings for saving each date attribute (PHP format example)
			'saveSettings' => [
				Module::FORMAT_DATE => 'php:Y-m-d',
				Module::FORMAT_TIME => 'php:H:i:s',
				Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
			],
	 
			// set your display timezone
			'displayTimezone' => 'Europe/Ljubljana',
	 
			// set your timezone for date saved to db
			'saveTimezone' => 'Europe/Ljubljana',
			
			// automatically use kartik\widgets for each of the above formats
			'autoWidget' => true,
	 
			// default settings for each widget from kartik\widgets used when autoWidget is true
			'autoWidgetSettings' => [
				Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
				Module::FORMAT_DATETIME => [], // setup if needed
				Module::FORMAT_TIME => [], // setup if needed
			],
			
			// custom widget settings that will be used to render the date input instead of kartik\widgets,
			// this will be used when autoWidget is set to false at module or widget level.
			'widgetSettings' => [
				Module::FORMAT_DATE => [
					'class' => 'yii\jui\DatePicker', // example
					'options' => [
						'dateFormat' => 'php:j. n. Y',
						'options' => ['class'=>'form-control'],
					]
				]
			]
        ]
	],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fvpDze8Oi7mRDkI6LVLhZNTN2FEenguL',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],	
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'mailer' => [
				'class' => 'yii\swiftmailer\Mailer',
				'viewPath' => '@app/mailer',
				'useFileTransport' => false,
				'transport' => [
					'class' => 'Swift_SmtpTransport',
					'host' => 'smtp.gmail.com',
					'username' => 'dostop@triing.si',
					'password' => 'D0st0pG00gl3G3sl0',
					'port' => '587',
					'encryption' => 'tls',
				],
		],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['194.249.214.66', '86.58.21.177'],
    ];
}

return $config;
