<?php
$params = array_merge(
    require(__DIR__ . '/../common/config/params.php'),
    require(__DIR__ . '/../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

return [
    'id' => 'app-frontend',
    'basePath' => $basePath,
    'runtimePath' => $webroot . '/app/runtime',
    'vendorPath' => $webroot . '/vendor',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\sites\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
    ],
    'params' => $params,
];
