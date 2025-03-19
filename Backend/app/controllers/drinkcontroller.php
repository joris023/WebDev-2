<?php

namespace Controllers;

use Exception;
use Services\DrinkService;

class DrinkController extends Controller {
    private $drinkService;

    function __construct() {
        $this->drinkService = new DrinkService();
    }

    function getAllDrinks() {
        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $Drinks = $this->drinkService->getAllDrinks($offset, $limit);
        $this->respond($Drinks);
    }

    function getDrinkById($id) {
        
        $drink = $this->drinkService->getDrinkById($id);
        $this->respond($drink);
    }

    public function insertDrink()
    {
        try {
            sleep(2);
            $drink = $this->createObjectFromPostedJson("Models\\Drink");

            $drinkId = $this->drinkService->insertDrink($drink);

            if (!$drinkId) {
                throw new Exception("Failed to insert drink");
            }

            $drink->id = $drinkId;

        } catch (Exception $e) {
            return $this->respondWithError(500, $e->getMessage());
        }

        return $this->respond($drink);
    }


    public function updateDrink($id)
    {
        try {
            sleep(2);
            $drink = $this->createObjectFromPostedJson("Models\\Drink");
            $drinkUpdated = $this->drinkService->updateDrink($drink, $id);

            if (!$drinkUpdated) {
                throw new Exception("Failed to insert drink");
            }

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($drinkUpdated);
    }


    public function deleteDrink($id)
    {
        try {
            $this->drinkService->deleteDrink($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}