<?php
use App\Repository\UserRepository;
use App\Repository\CityRepository;
use Psr\Container\ContainerInterface;

$container['user_repository'] = static fn (ContainerInterface $container): UserRepository => new UserRepository($container->get('db'));
$container['city_repository'] = static fn (ContainerInterface $container): CityRepository => new CityRepository($container->get('db'));
