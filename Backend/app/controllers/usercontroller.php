<?php

namespace Controllers;

use Exception;
use Services\UserService;
use \Firebase\JWT\JWT;

class UserController extends Controller
{
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function login() {
        try {
            sleep(2);
            $user = $this->createObjectFromPostedJson("Models\\User");
            $response = $this->userService->login($user);

            if(!$response) {
                $this->respondWithError(401);
            }
            $jwt = $this->userService->generateJWT($response);
            $this->respond($jwt);
        }
        catch (Exception $e) {
            return $this->respondWithError(500, $e->getMessage());
        }
    }

    public function register() {
        try {
            sleep(2);
            $user = $this->createObjectFromPostedJson("Models\\User");
            $userId = $this->userService->register($user);

            if(!$userId) {
                throw new Exception("Failed to register");
            }

            $this->respond($user);
        }
        catch (Exception $e) {
            return $this->respondWithError(500, $e->getMessage());
        }
    }
}
