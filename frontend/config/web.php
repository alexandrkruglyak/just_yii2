<?php
$config = [
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'modules' => [
        'tourfirms' => [
            'class' => 'frontend\modules\tourfirms\Module',
        ],
        'companions' => [
            'class' => 'frontend\modules\companions\Module',
        ],
        'countries' => [
            'class' => 'frontend\modules\countries\Module',
        ],
        'visa' => [
            'class' => 'frontend\modules\visa\Module',
        ],
        'tours' => [
            'class' => 'frontend\modules\tours\Module',
        ],
        'user' => [
            'class' => 'frontend\modules\user\Module'
        ],
        'api' => [
            'class' => 'frontend\modules\api\Module',
            'modules' => [
                'v1' => 'frontend\modules\api\v1\Module'
            ]
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*']
        ],
        'article' => [
            'class' => 'frontend\modules\article\Module',
        ],
    ],
    'components' => [
        'mymessages' => [
            //Обязательно
            'class'    => 'vision\messages\components\MyMessages',
            //не обязательно
            //класс модели пользователей
            //по-умолчанию \Yii::$app->user->identityClass
            'modelUser' => 'common\models\User',
            //имя контроллера где разместили action
            'nameController' => 'user/default',
            //не обязательно
            //имя поля в таблице пользователей которое будет использоваться в качестве имени
            //по-умолчанию username
            'attributeNameUser' => 'username',
            //не обязательно
            //можно указать роли и/или id пользователей которые будут видны в списке контактов всем кто не подпадает
            //в эту выборку, при этом указанные пользователи будут и смогут писать всем зарегестрированным пользователям
            //'admins' => ['admin'],
            //не обязательно
            //включение возможности дублировать сообщение на email
            //для работы данной функции в проектк должна быть реализована отправка почты штатными средствами фреймворка
            'enableEmail' => true,
            //задаем функцию для возврата адреса почты
            //в качестве аргумента передается объект модели пользователя

            //задаем функцию для возврата лого пользователей в списке контактов (для виджета cloud)
            //в качестве аргумента передается id пользователя
            /*'getLogo' => function($user_id) {
                return '\img\ghgsd.jpg';
            },*/
            //указываем шаблоны сообщений, в них будет передаваться сообщение $message

        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => getenv('GITHUB_CLIENT_ID'),
                    'clientSecret' => getenv('GITHUB_CLIENT_SECRET')
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => getenv('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => getenv('GITHUB_CLIENT_SECRET'),
                    'scope' => 'email,public_profile',
                    'attributeNames' => [
                        'name',
                        'email',
                        'first_name',
                        'last_name',
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'request' => [
            'cookieValidationKey' => getenv('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'messageCategory'=>'frontend'
            ]
        ]
    ];
    $config['modules']['debug'] = 'yii\debug\Module';
}

if (YII_ENV_PROD) {
    // Maintenance mode
    $config['bootstrap'] = ['maintenance'];
    $config['components']['maintenance'] = [
        'class' => 'common\components\maintenance\Maintenance',
        'enabled' => function ($app) {
            return $app->keyStorage->get('frontend.maintenance') === 'enabled';
        }
    ];

    // Compressed assets
    //$config['components']['assetManager'] = [
    //   'bundles' => require(__DIR__ . '/assets/_bundles.php')
    //];
}

return $config;
