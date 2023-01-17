<?php require_once("components/header.php") ?>

<?php

session_start();

require_once("database/database.php");
require_once("model/webshopOrder.php");

Database::connect();

if (isset($_SESSION["cart"])) {
  $cartIDs = $_SESSION["cart"];
} else {
  $cartIDs = [];
}

if (empty($cartIDs)) {
  header("Location: cart.php");
  die();
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

$error = "";

if (isset($_POST["checkout"])) {
  if (
    isset($_POST["email"]) &&
    isset($_POST["name"]) &&
    isset($_POST["address"]) &&
    isset($_POST["cardname"]) &&
    isset($_POST["cardnum"]) &&
    isset($_POST["cvv"]) &&
    isset($_POST["tnc"])
  ) {
    $order = new WebshopOrder(0, $_POST["email"], $_POST["name"], $_POST["address"], $sum, null);
    Database::createOrder($order);
    unset($_SESSION["cart"]);
    header("Location: success.php");
    die();
  } else {
    $error = "Please fill in all the details and accept the Terms and Conditions.";
  }
}
?>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1>Checkout</h1>
        <p class="text-danger"><?= $error ?></p>
        <form method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" class="form-control" name="email">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" id="name" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="address" id="address" class="form-control" name="address">
          </div>
          <h4>Card Details</h4>
          <div class="mb-3">
            <label for="cardname" class="form-label">Name on Card</label>
            <input type="name" id="cardname" class="form-control" name="cardname">
          </div>
          <div class="mb-3">
            <label for="cardnum" class="form-label">Card Number</label>
            <input type="number" id="cardnum" class="form-control" name="cardnum">
          </div>
          <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="number" id="cvv" class="form-control" name="cvv">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" id="tnc" name="tnc" class="form-check-input">
            <label class="form-check-label" for="tnc">I accept the Terms and Conditions</label>
          </div>
          <h4>Total: <?= $sum ?> Ft</h4>
          <button type="submit" name="checkout" class="btn btn-primary">Confirm Payment</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once("components/footer.php") ?>