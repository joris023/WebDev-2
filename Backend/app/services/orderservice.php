<?php

namespace Services;

use Repositories\OrderRepository;

class OrderService {
    private $orderRepository;

    public function __construct() {
        $this->orderRepository = new OrderRepository();
    }

    public function getAllOrders() {
        return $this->orderRepository->getAllOrders();
    }

    public function getOrderById($id) {
        return $this->orderRepository->getOrderById($id);
    }

    public function insertOrder($order) {
        return $this->orderRepository->insertOrder($order);
    }

    public function deleteOrder($id) {
        return $this->orderRepository->deleteOrder($id);
    }
}