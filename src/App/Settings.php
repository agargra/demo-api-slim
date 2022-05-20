<?php 
return [
    'settings' => [
        'db' => [
            'host' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_NAME'],
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PASS'],
            'port' => $_SERVER['DB_PORT']
        ],
        'redis' => [
            'enabled' => $_SERVER['REDIS_ENABLED'],
            'host' => $_SERVER['REDIS_HOST'],
            'port' => $_SERVER['REDIS_PORT'],
            'user' => $_SERVER['REDIS_USER'],
            'pass' => $_SERVER['REDIS_PASS']
        ],        
        'app' => [
            'secret' => $_SERVER['SECRET_KEY'],
        ],        
    ],
];