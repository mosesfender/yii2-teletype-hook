<?php

$params = array_merge(
    require(__DIR__ . '/../../../common/config/params.php'),
    require(__DIR__ . '/../../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'tthook',
    'name'                => 'Test Teletype Hook',
    'homeUrl'             => '/',
    'defaultRoute'        => 'teletype/test-page',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'tthook\controllers',
    'components'          => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'normalizer'      => [
                'class'                  => '\yii\web\UrlNormalizer',
                'action'                 => \yii\web\UrlNormalizer::ACTION_REDIRECT_PERMANENT,
                'collapseSlashes'        => true,
                'normalizeTrailingSlash' => true,
            ],
            'rules'           => [
                '<controller:[\w \-]+>/<action:[\w \-]+>' => '<controller>/<action>',
            ],
        ],
        'request'              => [
            'baseUrl'             => '',
            'cookieValidationKey' => '_uRtdnT7R510_',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'log' => [
            'flushInterval' => 1,
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => '\tthook\components\MessageTarget',
                    'exportInterval' => 1,
                    'categories' => ['tt_client_messages'],
                    'levels' => ['info'],
                    'logFile' => $params['clientLog'],
                    'logVars' => []
                ],                [
                    'class' => '\tthook\components\MessageTarget',
                    'exportInterval' => 1,
                    'categories' => ['tt_operator_messages'],
                    'levels' => ['info'],
                    'logFile' => $params['operatorLog'],
                    'logVars' => []
                ],
            ],
        ],
    ],
    'params' => $params,
];