<?php
namespace App\Service\User;

use App\Repository\UserRepository;
use App\Service\BaseService;

abstract class Base extends BaseService
{
    protected UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

}