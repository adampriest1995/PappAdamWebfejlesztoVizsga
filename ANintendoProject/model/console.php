<?php

require_once("model/product.php");

class Console extends Product
{
    public $color;
    public $storage;
    public $warranty;

    public function __construct($id, $name, $price, $inStock, $description, $createdAt, $color, $storage, $warranty)
    {
        parent::__construct($id, $name, $price, $inStock, $description, $createdAt);

        $this->color = $color;
        $this->storage = $storage;
        $this->warranty = $warranty;
    }
}