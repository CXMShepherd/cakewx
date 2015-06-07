<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [             
            'enablePrettyUrl' => true,
            'showScriptName' => true, 
            'rules' => [       
                'debug/<controller>/<action>' => 'debug/<controller>/<action>',    
            ],                        
        ],
    ],
];
