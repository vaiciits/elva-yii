<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'db' => [
            'class' => \yii\db\Connection::class,
            // 'dsn' => 'sqlsrv:Server=sqlserver;Database=master',
            // 'username' => 'sa',
            // 'password' => '#password123sdJwnwlk',
            'dsn' => getenv('DB_DSN'),
            'username' =>  getenv('DB_USERNAME'),
            'password' =>  getenv('DB_PASSWORD'),
            'charset' => 'utf8',
        ],
    ],
];