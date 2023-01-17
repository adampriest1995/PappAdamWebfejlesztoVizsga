<?php require_once("components/header.php") ?>

<?php

$error = "";

require_once("model/console.php");
require_once("model/figure.php");
require_once("model/game.php");
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

if (isset($_GET["category"])) {
  $category = $_GET["category"];
} else {
  $category = "unknown";
}

if (
  isset($_POST["name"]) &&
  isset($_POST["price"]) &&
  isset($_POST["description"]) &&
  isset($_POST["category"])
) {

  $name = $_POST["name"];
  $price = $_POST["price"];
  $description = $_POST["description"];
  $category = $_POST["category"];

  switch ($category) {    
      case "console": {
        $color = $_POST["color"];
        $storage = $_POST["storage"];
        $warranty = $_POST["warranty"];
        
        $newProduct = new Console(0, $name, $price, true, $description, NULL, $color, $storage, $warranty);

        break;
      }
      case "figure": {
        $franchise = $_POST["franchise"];
        $theme = $_POST["theme"];
                
        $newProduct = new Figure(0, $name, $price, true, $description, NULL, $franchise, $theme);

        break;
      }
      case "game": {
        $age = $_POST["age"];
        $platform = $_POST["platform"];
        $genre = $_POST["genre"];
        
        $newProduct = new Game(0, $name, $price, true, $description, NULL, $age, $platform, $genre);

        break;
      }
  }

  Database::connect();

  Database::createProduct($newProduct);

  header("Location: admin.php");
  exit();
}

?>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1>New Product</h1>
        <p class="text-danger"><?= $error ?></p>
        <?php if ($category != "unknown") : ?>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="id" id="id" class="form-control" readonly name="id">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" id="name" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" class="form-control" name="price">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" class="form-control" name="description">
          </div>
          <div class="mb-3">
            <label for="created-at" class="form-label">Created At</label>
            <input type="text" readonly id="created-at" class="form-control">
          </div>
                  

          <hr>

          <?php if ($category == "console") : ?>

          <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" id="color" class="form-control" name="color">
          </div>
          <div class="mb-3">
            <label for="storage" class="form-label">Storage</label>
            <input type="number" id="storage" class="form-control" name="storage">
          </div>
          <div class="mb-3">
            <label for="warranty" class="form-label">Warranty</label>
            <input type="number" id="warranty" class="form-control" name="warranty">
          </div>

          <?php elseif ($category == "figure") : ?>

          <div class="mb-3">
            <label for="franchise" class="form-label">Franchise</label>
            <input type="text" id="franchise" class="form-control" name="franchise">
          </div>
          <div class="mb-3">
            <label for="theme" class="form-label">Theme</label>
            <input type="text" id="theme" class="form-control" name="theme">
          </div>

          <?php elseif ($category == "game") : ?>

          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" id="age" class="form-control" name="age">
          </div>
          <div class="mb-3">
            <label for="platform" class="form-label">Platform</label>
            <input type="text" id="platform" class="form-control" name="platform">
          </div>
          <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" id="genre" class="form-control" name="genre">
          </div>

          <?php endif ?>

          <input type="hidden" name="category" value="<?= $category ?>">
          <button type="submit" name="checkout" class="btn btn-danger">Save</button>
        </form>

        <?php else : ?>

        <form method="GET">
          <select class="form-select mb-3" name="category">
            <option value="console">Console</option>
            <option value="figure">Figure</option>
            <option value="game">Game</option>
          </select>
          <button type="submit" class="btn btn-danger">Create</button>
        </form>

        <?php endif ?>

      </div>
    </div>
  </div>
</div>

<?php require_once("components/footer.php") ?>