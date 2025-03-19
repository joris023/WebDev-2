<?php
namespace Models;

class Food{

    public int $id;
    public string $name;
    public float $price;
    public string $description;
    public ?string $image;
    public int $stock;
    //public int $quantity = 0;
}
