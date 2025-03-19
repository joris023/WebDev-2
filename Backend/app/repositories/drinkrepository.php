<?php

namespace Repositories;

use Models\Drink;

use PDO;
use PDOException;
use Repositories\Repository;

class DrinkRepository extends Repository {

    public function getAllDrinks($offset = NULL, $limit = NULL) {
        try {
            $query = "SELECT * FROM drinks";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT ? OFFSET ? ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->execute([$limit, $offset]);
            }
            else{ $stmt->execute(); }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $drinkArray = $stmt->fetchAll();
            
            $drinks = [];
            foreach ($drinkArray as $row) {
                $drink = new Drink();
                $drink->id = $row['id'];
                $drink->name = $row['name'];
                $drink->price = $row['price'];
                $drink->description = $row['description'];
                $drink->image = $row['image'] ?? null;
                $drink->stock = $row['stock'];

                $drinks[] = $drink; // Add to result array
            }

            return $drinks;
        } catch (PDOException $e) {
            error_log("Database error in getAllDrinks: " . $e->getMessage());
            return [];
        }
    }

    public function getDrinkById($id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM drinks WHERE id = ?");
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\Drink');
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Database error in getDrinkById: " . $e->getMessage());
            return null;
        }
    }
    
    public function insertDrink($drink) {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO drinks (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $drink->name,
                $drink->description,
                $drink->price,
                $drink->stock,
                $drink->image
            ]);
    
            return $this->connection->lastInsertId(); // ✅ Only return the ID, no output
        } catch (PDOException $e) {
            error_log("Database error in insertDrink: " . $e->getMessage());
            return false;
        }
    }

    function updateDrink($product, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE drinks SET name = ?, price = ?, description = ?, image = ?, stock = ? WHERE id = ?");

            $stmt->execute([$product->name, $product->price, $product->description, $product->image, $product->stock, $id]);

            return $this->getDrinkById($id);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    function deleteDrink($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM drinks WHERE id = ?");
            $stmt->execute([$id]);
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}