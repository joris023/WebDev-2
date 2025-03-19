<?php
namespace Services;

use Repositories\DrinkRepository;

class Drinkservice {

    private $drinkRepository;

    public function __construct() {
        $this->drinkRepository = new DrinkRepository();
    }

    public function getAllDrinks($offset = NULL, $limit = NULL) {
        return $this->drinkRepository->getAllDrinks($offset, $limit);
    }

    public function getDrinkById($id) {
        return $this->drinkRepository->getDrinkById($id);
    }

    public function insertDrink($drink) {
        return $this->drinkRepository->insertDrink($drink);
    }

    public function updateDrink($drink, $id) {
        return $this->drinkRepository->updateDrink($drink, $id);
    }

    public function deleteDrink($id) {
        return $this->drinkRepository->deleteDrink($id);
    }
}