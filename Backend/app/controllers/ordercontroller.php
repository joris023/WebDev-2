<?php

namespace Controllers;

use Exception;
use Services\OrderService;

class OrderController extends Controller{
    private $orderService;

    public function __construct() {
        $this->orderService = new OrderService();
    }

    public function getAllOrders() {
        $orders = $this->orderService->getAllOrders();
        $this->respond($orders);
    }

    public function getOrderById($id) {
        $order = $this->orderService->getOrderById($id);
        $this->respond($order);
    }

    public function insertOrder() {
        try {
            sleep(2);
            $order = $this->createObjectFromPostedJson("Models\\Order");
            $orderID = $this->orderService->insertOrder($order);

            if (!$orderID) {
                throw new Exception("Failed to insert order");
            }

            $order->id = $orderID;

        } catch (Exception $e) {
            return $this->respondWithError(500, $e->getMessage());
        }
        return $this->respond($order);
    }

    public function deleteOrder($id) {
        $response = $this->orderService->deleteOrder($id);
        $this->respond($response);
    }
}