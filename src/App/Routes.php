<?php
use App\Controller\City;
use App\Controller\User;
use App\Middleware\Auth;

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->post('/login', \App\Controller\User\Login::class);

$app->group('/api/v1', function () use ($app): void {
  
    $app->group('/cities', function () use ($app): void {
        $app->get('', City\GetAll::class);
        $app->get('/{id}', City\GetOne::class);
    })->add(new Auth());
    
});