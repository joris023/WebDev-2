<?php

namespace Repositories;

use Models\Order;

use PDO;
use PDOException;
use Repositories\Repository;

class OrderRepository extends Repository{

    public function getAllOrders() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $orderArray = $stmt->fetchAll();
            $orders = [];

            foreach ($orderArray as $row) {
                $order = new Order();
                $order->id = (int) $row['id'];
                $order->user_id = (int) $row['user_id'];
                $order->table_number = (int) $row['table_number'];
                $order->total_amount = (float) $row['total_amount'];
                $order->created_at = (string) $row['created_at'];

                $orders[] = $order;
            }
            return $orders;
        }
        catch (PDOException $e) {
            error_log("somethin went worng in the Getallorders:::". $e->getMessage());
            return [];
        }
    }

    public function getOrderById($id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id = ?");
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch(); // Fixed syntax
    
            // Check if order exists
            if (!$row) {
                return null; // Return null if no order is found
            }
    
            $order = new Order();
            $order->id = (int) $row['id'];
            $order->user_id = (int) $row['user_id'];
            $order->table_number = (int) $row['table_number'];
            $order->total_amount = (float) $row['total_amount'];
            $order->created_at = (string) $row['created_at'];
    
            return $order;
        } catch (PDOException $e) {
            error_log("Something went wrong in getOrderById: " . $e->getMessage());
            return null;
        }
    }    

    public function insertOrder($order) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO orders (user_id, table_number, total_amount) VALUES (?, ?, ?)");
            
            $stmt->execute([
                $order->user_id,
                $order->table_number,
                $order->total_amount
            ]);
    
            return $this->connection->lastInsertId(); 
        } catch (PDOException $e) {
            error_log("Something went wrong in insertOrder: " . $e->getMessage());
            return null; // Return false instead of null
        }
    }
    
    public function deleteOrder($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM orders WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}