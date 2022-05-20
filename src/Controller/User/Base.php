<?php
namespace App\Controller\User;

use App\Controller\BaseController;
use App\Exception\User;
use App\Service\User\LoginService;

abstract class Base extends BaseController
{
    protected function getLoginUserService(): LoginService
    {
        return $this->container->get('login_user_service');
    }

}