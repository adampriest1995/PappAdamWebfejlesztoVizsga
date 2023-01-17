<?php require_once("components/header.php") ?>

<?php

require_once("database/database.php");

Database::connect();

?>

<div class="row">

  <?php
  $products = Database::getAllProducts();

  foreach ($products as $product) {
    echo "
        <div class='col-md-3'>
          <div class='card mb-3'>
            <img src='/ANintendoProject/img/{$product->id}.jpg' class='card-img-top' alt='...'>
            <div class='card-body'>
              <h5 class='card-title'>{$product->name}</h5>
              <p class='card-text'>{$product->description}</p>
              <p class='card-text'>Ft {$product->price}</p>
              <a href='prod.php?id={$product->id}' class='btn btn-secondary'>Details</a>
              <a href='cart.php?id={$product->id}' class='btn btn-danger'>Add to cart</a>
            </div>
          </div>
        </div>
      ";
  }
  ?>

</div>

<?php require_once("components/footer.php") ?>