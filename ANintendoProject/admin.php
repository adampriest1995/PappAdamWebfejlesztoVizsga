<?php require_once("components/header.php") ?>

<h1>Admin</h1>

<?php

require_once("database/database.php");

if (
  isset($_SERVER['PHP_AUTH_USER']) &&
  isset($_SERVER['PHP_AUTH_PW']) &&
  $_SERVER['PHP_AUTH_USER'] == "nintendo-project" &&
  $_SERVER['PHP_AUTH_PW'] == "jelszo123"
) {
} else {
  header('WWW-Authenticate: Basic realm="NintendoWebshop"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'You cannot access the Admin console';
  exit();
}

Database::connect();

Database::connect();

if (isset($_GET["deleteproduct"])) {
  $deleteProductId = $_GET["deleteproduct"];
  Database::deleteProductById($deleteProductId);
  header("Location: admin.php");
  exit();
}

if (isset($_GET["deleteorder"])) {
  $deleteOrderId = $_GET["deleteorder"];
  Database::deleteOrderById($deleteOrderId);
  header("Location: admin.php");
  exit();
}

$orders = Database::getAllOrders();

$products = Database::getAllProducts();

?>

<h4>Orders</h4>

<table class="table table-sm">
  <thead>
    <th>ID</th>
    <th>Email</th>
    <th>Name</th>
    <th>Address</th>
    <th>Total</th>
    <th>Date</th>
    <th></th>
  </thead>

  <?php foreach ($orders as $order) : ?>
  <tr>
    <td><?= $order->id ?></td>
    <td><?= $order->email ?></td>
    <td><?= $order->name ?></td>
    <td><?= $order->address ?></td>
    <td><?= $order->total ?></td>
    <td><?= $order->date ?></td>
    <td>
      <a class="btn btn-sm btn-danger" href="?deleteorder=<?= $order->id ?>">
        <i class="bi bi-trash"></i>
      </a>
    </td>
  </tr>
  <?php endforeach ?>
</table>

<h4>Products</h4>
<a href="newproduct.php" class="btn btn-danger">Add Product</a>
<table class="table table-sm">
  <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>In Stock</th>
    <th>Created At</th>
    <th></th>
  </thead>

  <?php foreach ($products as $product) : ?>
  <tr>
    <td><?= $product->id ?></td>
    <td><?= $product->name ?></td>
    <td><?= $product->price ?> Ft</td>
    <td><?= $product->inStock == 1 ? "Yes" : "No" ?></td>
    <td><?= $product->createdAt ?></td>
    <td>
      <a href="?deleteproduct=<?= $product->id ?>" class="btn btn-sm btn-danger" href="">
        <i class="bi bi-trash"></i>
      </a>
    </td>
  </tr>
  <?php endforeach ?>
</table>

<?php require_once("components/footer.php") ?>