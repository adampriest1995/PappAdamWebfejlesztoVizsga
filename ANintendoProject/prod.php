<?php require_once("components/header.php") ?>

<?php

require_once("database/database.php");

Database::connect();

if (isset($_GET["id"])) {

  $id = $_GET["id"];

  $product = Database::getProductById($id);
}

?>

<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/ANintendoProject/img/<?= $product->id ?>.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $product->name ?></h5>
        <p class="card-text"><?= $product->description ?></p>
        <p class="card-text"> <?= $product->price ?> Ft</p>
        <p class="card-text"><?= $product->inStock == 1 ? "In stock" : "Not in stock" ?></p>                
        <p class="card-text"><small class="text-muted">Added at <?= $product->createdAt ?></small></p>
        <a href='cart.php?id=<?= $product->id ?>' class='btn btn-danger'>Add to cart</a>
      </div>
    </div>
  </div>
</div>

<?php require_once("components/footer.php") ?>