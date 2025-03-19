<?php

namespace Controllers;

use Exception;
use Services\FoodService;

class FoodController extends Controller {
    private $foodService;

    function __construct() {
        $this->foodService = new FoodService();
    }

    function getAllFoods() {
        $token = $this->checkForJwt();

        if (!$token) {
            exit;
        }

        // print_r($token);
        // exit;

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $Foods = $this->foodService->getAllFoods($offset, $limit);
        $this->respond($Foods);
    }

    function getFoodById($id) {
        
        $food = $this->foodService->getFoodById($id);
        $this->respond($food);
    }

    public function insertFood()
    {
        try {
            sleep(2);
            $food = $this->createObjectFromPostedJson("Models\\Food");
            $foodId = $this->foodService->insertFood($food);

            if (!$foodId) {
                throw new Exception("Failed to insert food");
            }

            $food->id = $foodId;

        } catch (Exception $e) {
            return $this->respondWithError(500, $e->getMessage());
        }
        return $this->respond($food);
    }


    public function updateFood($id)
    {
        try {
            sleep(2);
            $food = $this->createObjectFromPostedJson("Models\\Food");
            $foodupdated = $this->foodService->updateFood($food, $id);

            if (!$foodupdated) {
                throw new Exception("Failed to insert food");
            }

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
        $this->respond($foodupdated);
    }


    public function deleteFood($id)
    {
        try {
            $this->foodService->deleteFood($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}