<?php

class Product
{
    public $id;
    public $name;
    public $price;
    public $inStock;
    public $description;
    public $createdAt;
    
    public function __construct($id, $name, $price, $inStock, $description, $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->createdAt = $createdAt;
    }
}