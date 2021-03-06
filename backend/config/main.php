<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
            'cookieValidationKey' => 'dsgfsgdhsgdrgdfghfh',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
	    /*admin lte*/
        'view' => [
	        'theme' => [
		        'pathMap' => [
			        '@app/views' => '@backend/views'
		        ],
	        ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
	            '/' => 'admin/index',
	            '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
	            'page/<view:[a-zA-Z0-9-]+>' => 'site/page',
                'motor' => 'motor-transport/index',
                'users' => 'user/index',
            ],
        ],
        'cache' => [
	        'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
	        'class' => 'dektrium\rbac\components\DbManager',
        ],
    ],
    'params' => $params,
];
