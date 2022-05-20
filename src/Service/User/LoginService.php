<?php
namespace App\Service\User;

use App\Exception\User as CustomException;
use Firebase\JWT\JWT;

final class LoginService extends Base
{
    public function login(array $input): string
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->email)) {
            throw new CustomException('The field "email" is required.', 400);
        }
        if (! isset($data->password)) {
            throw new CustomException('The field "password" is required.', 400);
        }
        $password = hash('sha512', $data->password);
        $user = $this->userRepository->loginUser($data->email, $password);
        $token = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'iat' => time(),
            'exp' => time() + (7 * 24 * 60 * 60),
        ];

        return JWT::encode($token, $_SERVER['SECRET_KEY']);
    }
}