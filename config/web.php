<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Доска объявлений',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '82688sdfgsdfg554',
            'baseUrl' => ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/site/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],

    'params' => $params,

    //Global access control (behaviors)

    'as access' => [
        'class' => \yii\filters\AccessControl::className(),
        'rules' => [

            [
                'allow' => true,
                'controllers' => ['admin/*'],
                'matchCallback' => function($rule, $action){
                    if(!Yii::$app->getUser()->isGuest && Yii::$app->user->identity->isAdmin === 1)
                        return true;
                }
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
            ],
            [
                'controllers' => ['announcement'],
                'allow' => true,
                'matchCallback' => function($rule, $action){
                    if ($action->id === 'create') {
                        return !Yii::$app->user->isGuest && Yii::$app->user->identity->status !== 0;
                    }
                    if (in_array($action->id, ['update', 'delete', 'set-image', 'set-category'])) {
                        if (Yii::$app->user->isGuest || Yii::$app->user->identity->status === 0)
                            return false;
                        $announcementId = Yii::$app->request->get('id');
                        return $announcementId && Yii::$app->user->id === \app\models\Announcement::findOne(['id' => $announcementId])->user_id;
                    }
                    else
                        return true;
                }
            ],
            [
                'allow' => true,
                'controllers' => ['debug/*']
            ],
            [
                'allow' => true,
                'controllers' => ['gii/*'],
            ],
        ],
    ],

    'as verbs' => [
        'class' => \yii\filters\VerbFilter::className(),

            'actions' => [
                'delete' => ['post'],
                'logout' => ['post'],
            ],

    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
