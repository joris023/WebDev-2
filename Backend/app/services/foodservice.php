<?php
namespace Services;

use Repositories\FoodRepository;

class FoodService {

    private $foodRepository;

    public function __construct() {
        $this->foodRepository = new FoodRepository();
    }

    public function getAllFoods($offset = NULL, $limit = NULL) {
        return $this->foodRepository->getAllFoods($offset, $limit);
    }

    public function getFoodById($id) {
        return $this->foodRepository->getFoodById($id);
    }

    public function insertFood($food) {
        return $this->foodRepository->insertFood($food);
    }

    public function updateFood($food, $id) {
        return $this->foodRepository->updateFood($food, $id);
    }

    public function deleteFood($id) {
        return $this->foodRepository->deleteFood($id);
    }
}