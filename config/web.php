<?php

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
	],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fvpDze8Oi7mRDkI6LVLhZNTN2FEenguL',
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
            'rules' => [
				'organization' => 'organization/index',
				'organization/index' => 'organization/index',
				'organization/create' => 'organization/create',
				'organization/view/<id:\d+>' => 'organization/view',  
				'organization/update/<id:\d+>' => 'organization/update',  
				'organization/delete/<id:\d+>' => 'organization/delete',  
				'organization/<slug>' => 'organization/slug',
				'defaultRoute' => '/site/index',
				['class' => 'yii\rest\UrlRule', 'controller' => ['api/organization' => 'organizationapi']],
				['class' => 'yii\rest\UrlRule', 'controller' => ['api/user' => 'userapi']],
            ],
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
