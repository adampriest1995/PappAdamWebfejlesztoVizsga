<?php

require_once("model/product.php");

class Game extends Product
{
    public $age;
    public $platform;
    public $genre;

    public function __construct($id, $name, $price, $inStock, $description, $createdAt, $age, $platform, $genre)
    {
        parent::__construct($id, $name, $price, $inStock, $description, $createdAt);

        $this->age = $age;
        $this->platform = $platform;
        $this->genre = $genre;
    }
}