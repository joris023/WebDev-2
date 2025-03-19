<?php
namespace Models;

class Order{

    public int $id;
    public int $user_id;
    public int $table_number;
    public float $total_amount;
    public string $created_at;
}
