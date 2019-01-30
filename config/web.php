<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';


$config = [
    'id' => 'kropsys',
    'name' => 'KROPSYS Admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'America/Santiago',
    'language' => 'es-CL',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HjiexW7CbaLvXAmgbJe3kacZjUAEPLxR',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        //     'enableAutoLogin' => true,
        // ],
        'google' => [
            'class' => 'idk\yii2\google\apiclient\components\GoogleApiClient',
            'credentialsPath' => '@runtime/google-apiclient/gmail.json',
            'clientSecretPath' => '@runtime/google-apiclient/secret.json',
         ],

         'fs' => [
            'class' => 'creocoder\flysystem\AwsS3Filesystem',
            'key' => 'AKIAJEW7A45GBAOLIM4A',
            'secret' => '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',
            'bucket' => 'kropsysfiles',
            'region' => 'sa-east-1',
            'version' => 'latest',
            // 'baseUrl' => 'your-base-url',
            // 'prefix' => 'your-prefix',
            // 'options' => [],
            // 'endpoint' => 'http://my-custom-url'
        ],

        

        'user' => [
        'class' => 'webvimark\modules\UserManagement\components\UserConfig',

        // Comment this if you don't want to record user logins
        'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

        'formatter' => [
        'class'           => 'yii\i18n\Formatter',
        'defaultTimeZone' => 'America/Santiago',
    ],

     'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // 'enableSwiftMailerLogging' => true,
            // 'useFileTransport' => true,
            'transport' => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.gmail.com',
                'username'   => 'soporte@kropsys.cl',
                'password'   => 'pandora!x2012',
                'port'       => '587',
                'encryption' => 'tls',
            ],
        ],

    'assetManager' => [
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
            ],
            'yii\bootstrap\BootstrapPluginAsset' =>[
                'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
            ]
        ],
    ],

//     'pusher' => [
//     'class'     => 'br0sk\pusher\Pusher',
//     //Mandatory parameters
//     'appId'     => '451334',
//     'appKey'    => 'd2cee8a3e04c9befaf5d',
//     'appsecret' => 'dfba06368a2378a61987',
//     //Optional parameter
//     'options'   => ['encrypted' => true]
// ],

'pusher' => [
    'class' => 'br0sk\pusher\Pusher',
    /*
     * Mandatory parameters.
     */
    'appId' => '451334',
    'appKey' => 'd2cee8a3e04c9befaf5d',
    'appSecret' => 'dfba06368a2378a61987',
    /*
     * Optional parameters.
     */
   // 'options' => ['encrypted' => true, 'cluster' => 'YOUR_APP_CLUSTER']
    'options'   => ['encrypted' => true, 'cluster' => 'us2']
],


    ],
    'params' => $params,
    'modules'=>[
                'user-management' => [
                    'class' => 'webvimark\modules\UserManagement\UserManagementModule',

                    // 'enableRegistration' => true,

                    // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
                    // The example below allows user to enter :
                    // any set of characters
                    // (?=\S{8,}): of at least length 8
                    // (?=\S*[a-z]): containing at least one lowercase letter
                    // (?=\S*[A-Z]): and at least one uppercase letter
                    // (?=\S*[\d]): and at least one number
                    // $: anchored to the end of the string

                    //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',
                    

                    // Here you can set your handler to change layout for any controller or action
                    // Tip: you can use this event in any module
                    'on beforeAction'=>function(yii\base\ActionEvent $event) {
                            if ( $event->action->uniqueId == 'user-management/auth/login' )
                            {
                                $event->action->controller->layout = 'loginLayout.php';
                            };
                        },
                ],
                'gii' => [
                        'class' => 'yii\gii\Module',
                        ],
                'admin' => [
                        'class' => 'app\modules\admin\Module',
                ],
                'monitoreo' => [
                        'class' => 'app\modules\monitoreo\Module',
                 ],
                 'tareas' => [
                         'class' => 'app\modules\tareas\Module',
                   ],
                  'dashboard' => [
                         'class' => 'app\modules\dashboard\Module',
                         // 'layout' => '@dashboard/views/layouts/main'
                 ],
                 'clientes' => [
                        'class' => 'app\modules\clientes\Module',
                ],
                 'tickets' => [
                        'class' => 'app\modules\tickets\Module',
                    ],
                'areaclientes' => [
                        'class' => 'app\modules\areaclientes\Module',
                    ],
                 'mistickets' => [
                        'class' => 'app\modules\mistickets\Module',
                ],
                'asunto' => [
                        'class' => 'app\modules\asunto\Module',
                ],
                'notifications' => [
                        'class' => 'webzop\notifications\Module',
                        'channels' => [
                        'screen' => [
                        'class' => 'webzop\notifications\channels\ScreenChannel',
                ],
                //         'email' => [
                //         'class' => 'webzop\notifications\channels\EmailChannel',
                //         'message' => [
                //         'from' => 'example@email.com'
                //         ],
                // ],
            ],
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
