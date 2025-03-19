<?php

namespace Repositories;

use Models\Food;

use PDO;
use PDOException;
use Repositories\Repository;

class FoodRepository extends Repository {

    public function getAllFoods($offset = NULL, $limit = NULL) {
        try {
            $query = "SELECT * FROM foods";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT ? OFFSET ? ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->execute([$limit, $offset]);
            }
            else{ $stmt->execute(); }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $foodArray = $stmt->fetchAll();
            
            $foods = [];
            foreach ($foodArray as $row) {
                $food = new Food();
                $food->id = $row['id'];
                $food->name = $row['name'];
                $food->price = $row['price'];
                $food->description = $row['description'];
                $food->image = $row['image'] ?? null;
                $food->stock = $row['stock'];

                $foods[] = $food; // Add to result array
            }

            return $foods;
        } catch (PDOException $e) {
            error_log("Database error in getAllFoods: " . $e->getMessage());
            return [];
        }
    }

    public function getFoodById($id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM foods WHERE id = ?");
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\Food');
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Database error in getFoodById: " . $e->getMessage());
            return null;
        }
    }
    
    public function insertFood($food) {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO foods (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $food->name,
                $food->description,
                $food->price,
                $food->stock,
                $food->image
            ]);
    
            return $this->connection->lastInsertId(); // ✅ Only return the ID, no output
        } catch (PDOException $e) {
            error_log("Database error in insertFood: " . $e->getMessage());
            return false;
        }
    }

    function updateFood($product, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE foods SET name = ?, price = ?, description = ?, image = ?, stock = ? WHERE id = ?");

            $stmt->execute([$product->name, $product->price, $product->description, $product->image, $product->stock, $id]);

            return $this->getFoodById($id);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    function deleteFood($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM foods WHERE id = ?");
            $stmt->execute([$id]);
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}