<?php
use App\Service\User\LoginService;
use App\Service\City\CityService;
use App\Service\Forecast\PelmorexService;
use Psr\Container\ContainerInterface;

$container['login_user_service'] = static fn (ContainerInterface $container): LoginService => new LoginService($container->get('user_repository'));
$container['city_service'] = static fn (ContainerInterface $container): CityService => new CityService($container->get('city_repository'),$container->get('redis_service'));
$container['forecast_service'] = static fn (ContainerInterface $container): PelmorexService => new PelmorexService();