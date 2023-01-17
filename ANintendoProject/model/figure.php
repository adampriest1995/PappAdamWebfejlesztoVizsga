<?php

require_once("model/product.php");

class Figure extends Product
{
    public $franchise;
    public $theme;
    
    public function __construct($id, $name, $price, $inStock, $description, $createdAt, $franchise, $theme)
    {
        parent::__construct($id, $name, $price, $inStock, $description, $createdAt);

        $this->franchise = $franchise;
        $this->theme = $theme;
    }
}