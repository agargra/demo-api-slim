<?php
namespace App\Repository;

use App\Entity\User;
use App\Exception\User as CustomException;

final class UserRepository extends BaseRepository
{
    public function loginUser(string $email, string $password): User
    {
        $userDb = $this->builder
            ->select('*')
            ->from('users')
            ->where('email = ? AND password = ?')
            ->setParameter(0, $email)
            ->setParameter(1, $password)
            ->execute()
            ->fetch()
        ;
        if (! $userDb) {
            throw new CustomException('Login failed: Email or password incorrect.', 400);
        }

        $user = new User();
        $user->setId($userDb['id']);
        $user->setName($userDb['name']);
        $user->setEmail($userDb['email']);
        $user->setPassword($userDb['password']);

        return $user;
    }

}