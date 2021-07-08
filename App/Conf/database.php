<?php
return [
    'MYSQL' => [
        'host'          => '192.168.99.100',
        'port'          => '3307',
        'user'          => 'root',
        'timeout'       => '5',
        'charset'       => 'utf8mb4',
        'password'      => '123456',
        'database'      => 'test',
        'POOL_MAX_NUM'  => '20',
        'POOL_TIME_OUT' => '0.1',
    ],
    'REDIS'         => [
        'host'          => 'redis',
        'port'          => '6379',
        'auth'          => '',
        'POOL_MAX_NUM'  => '5',
        'POOL_TIME_OUT' => '0.1',
    ],
];