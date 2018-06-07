<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
//	        'class'=>'backend\components\LangUrlManager',
//	        'languages' => ['en', 'ru'],
	        'rules' => [
		        '' => 'site/index',
		        ['pattern' => 'robots', 'route' => 'robotsTxt/web/index', 'suffix' => '.txt'],
//		        '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
//		        'page/<view:[a-zA-Z0-9-]+>' => 'site/page',
	        ],

        ],
    ],
];
