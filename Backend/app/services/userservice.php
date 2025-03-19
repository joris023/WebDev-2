<?php
namespace Services;

use Repositories\UserRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserService {

    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login($user) {
        return $this->userRepository->login($user);
    }

    public function register($user) {
        return $this->userRepository->register($user);
    }

    public function generateJWT($user) {

        $refreshToken = 

        $key = 'YOUR_SECRET_KEY';
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 6000,
            'sub' => $user->id,
            'role' => $user->role
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        return $jwt;
    }

    public function createRefreshToken($user) {

        //$refreshToken = blablabla
        $this->userRepository->updateRefreshToken($user, $refreshToken);
    }

    public function updateRefreshToken($user, $token) {
        $this->userRepository->updateRefreshToken($user, $token);
    }

    public function refresh() {

    }

    private function generateTokens($user) {
        
    }
}

?>