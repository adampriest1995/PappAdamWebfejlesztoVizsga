<?php

class WebshopOrder
{
  public $id;
  public $email;
  public $name;
  public $address;
  public $total;
  public $date;

  public function __construct($id, $email, $name, $address, $total, $date)
  {
    $this->id = $id;
    $this->email = $email;
    $this->name = $name;
    $this->address = $address;
    $this->total = $total;
    $this->date = $date;
  }
}