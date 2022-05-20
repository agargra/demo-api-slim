<?php

use App\Handler\ApiError;
use App\Service\RedisService;
use Psr\Container\ContainerInterface;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$container['db'] = static function (ContainerInterface $container): Doctrine\DBAL\Connection {
    $dbconfig = $container->get('settings')['db'];
    $connection = DriverManager::getConnection(array(
        'dbname' => $dbconfig['name'],
        'user' => $dbconfig['user'],
        'password' => $dbconfig['pass'],
        'host' => $dbconfig['host'],
        'driver' => 'pdo_mysql',
        'charset' => 'utf8',
        'driverOptions' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        )
    ), $config = new Configuration);
    return $connection;
};

$container['errorHandler'] = static fn (): ApiError => new ApiError();

$container['notFoundHandler'] = static function () {
    return static function ($request, $response): void {
        throw new \App\Exception\NotFound('Route Not Found.', 404);
    };
};

$container['redis_service'] = static function ($container): RedisService {
    $redis = $container->get('settings')['redis'];
    return new RedisService(new \Predis\Client([
        'scheme' => 'tcp',
        'host'   => $redis['host'],
        'port'   => $redis['port'],
        'username'   => $redis['user'],
        'password'   => $redis['pass']
    ]));
};