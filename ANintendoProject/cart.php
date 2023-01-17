<?php require_once("components/header.php") ?>

<?php

session_start();

require_once("database/database.php");

Database::connect();

if (isset($_GET["id"])) {
  $productId = $_GET["id"];

  if (isset($_SESSION["cart"][$productId])) {
    $_SESSION["cart"][$productId] = $_SESSION["cart"][$productId] + 1;
  } else {
    $_SESSION["cart"][$productId] = 1;
  }

  header("Location: cart.php");
  die();
} else if (isset($_GET["remove"])) {
  $productId = $_GET["remove"];

  if (isset($_SESSION["cart"][$productId])) {
    if ($_SESSION["cart"][$productId] > 1) {
      $_SESSION["cart"][$productId] = $_SESSION["cart"][$productId] - 1;
    } else {
      unset($_SESSION["cart"][$productId]);
    }
  }

  header("Location: cart.php");
  die();
} else if (isset($_GET["delete"])) {
  $productId = $_GET["delete"];

  if (isset($_SESSION["cart"][$productId])) {
    unset($_SESSION["cart"][$productId]);
  }

  header("Location: cart.php");
  die();
}

if (isset($_SESSION["cart"])) {
  $cartIDs = $_SESSION["cart"];
} else {
  $cartIDs = [];
}

$cart = [];

foreach ($cartIDs as $cartID => $count) {
  $cart[] = [
    "product" => Database::getProductById($cartID),
    "count" => $count,
  ];
}

$sum = 0;

foreach ($cart as $cartItem) {
  $sum += $cartItem["product"]->price * $cartItem["count"];
}


?>

<h1>Cart</h1>

<div class="row">
  <div class="col-md-8">
    <ol class="list-group list-group-numbered">
      <?php
      foreach ($cart as $cartItem) {

        $product = $cartItem["product"];
        $count = $cartItem["count"];

        echo "
      <li class='list-group-item d-flex justify-content-between align-items-start'>
        <div class='ms-2 me-auto'>
          <div class='fw-bold'>
            {$product->name}
          </div>
          <p class='card-text'>
            $ {$product->price}
          </p>
        </div>
        <div style='width:8rem' class='input-group mb-3'>
        <a href='cart.php?remove={$product->id}' class='btn btn-outline-secondary' type='button'>-</a>
        <input type='text' class='form-control' readonly aria-label='Example text with two button addons'
        value='{$count}'>
        <a href='cart.php?id={$product->id}'  class='btn btn-outline-secondary' type='button'>+</a>
        </div>
        <a href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'>X</a>
      </li>
    ";
      }
      ?>
    </ol>
  </div>
  <div class="col-md-4">

    <div class="card">
      <div class="card-body">
        <h4>Delivery</h4>
        <p>FREE</p>
        <h4>Total</h4>
        <p><?= $sum ?> Ft</p>
        <?php if (empty($cart)) : ?>
        <a class="btn btn-danger disabled">Checkout</a>
        <?php else : ?>
        <a class="btn btn-danger" href="checkout.php">Checkout</a>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<?php require_once("components/footer.php") ?>