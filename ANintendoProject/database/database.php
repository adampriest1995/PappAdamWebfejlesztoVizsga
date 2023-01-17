<?php

require_once("model/console.php");
require_once("model/figure.php");
require_once("model/game.php");
require_once("model/webshopOrder.php");

class Database
{

  public static $conn;

  public static function connect()
  {
    $db_host = "localhost";
    $db_username = "nintendo-project";
    $db_password = "password123";
    $db_database = "nintendo-project";

    self::$conn = mysqli_connect(
      $db_host,
      $db_username,
      $db_password,
      $db_database,
    );
  }

  public static function createProduct($product)
    {
        $inStock = self::boolToSQL($product->inStock);
        
        if ($product instanceof Console) {
            $sql = "INSERT INTO `product` (`name`, `price`, `in_stock`, `description`, `created_at`,  `color`, `storage`, `warranty`, `category`) VALUES ('$product->name', '$product->price', '$inStock', '$product->description', current_timestamp(), '$product->color', '$product->storage', '$product->warranty', 'console');";
        } elseif ($product instanceof Figure) {
            $sql = "INSERT INTO `product` (`name`, `price`, `in_stock`, `description`, `created_at`,  `franchise`, `theme`, `category`) VALUES ('$product->name', '$product->price', '$inStock', '$product->description', current_timestamp(), '$product->franchise', '$product->theme', 'figure');";
        } elseif ($product instanceof Game) {
            $sql = "INSERT INTO `product` (`name`, `price`, `in_stock`, `description`, `created_at`,  `age`, `platform`, `genre`, `category`) VALUES ('$product->name', '$product->price', '$inStock', '$product->description', current_timestamp(), '$product->age', '$product->platform', '$product->genre', 'game');";
        }

        $result = mysqli_query(self::$conn, $sql);

        return $result;
    }

    public static function getAllProducts()
    {
        $sql = "SELECT * FROM `product` ;";
        $result = mysqli_query(self::$conn, $sql);
        
        $products = [];
    
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            switch ($row["category"]) {
                case "console": {
                    $products[] = new Console($row["id"], $row["name"], $row["price"], $row["in_stock"], $row["description"], $row["created_at"], $row["color"], $row["storage"], $row["warranty"]);
                    break;
                }
                case "figure": {
                    $products[] = new Figure($row["id"], $row["name"], $row["price"], $row["in_stock"], $row["description"], $row["created_at"], $row["color"], $row["franchise"], $row["theme"]);
                    break;
                }
                case "game": {
                    $products[] = new Game($row["id"], $row["name"], $row["price"], $row["in_stock"], $row["description"], $row["created_at"], $row["color"], $row["age"], $row["platform"], $row["genre"]);
                    break;
                }
                default: {
                    echo "Unknown category";
                }
            }

        }
            
        return $products;
      }
    }

    public static function getProductById($id) {
        $sql = "SELECT * FROM `product` WHERE `id` = $id ";

        $result = mysqli_query(self::$conn, $sql);
 
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            switch ($row["category"]) {
                case "console": {
                    return new Console($row["id"], $row["name"], $row["price"], $row["in_stock"], $row["description"], $row["created_at"], $row["color"], $row["storage"], $row["warranty"]);
                    break;
                }
                case "figure": {
                    return new Figure($row["id"], $row["name"], $row["price"], $row["in_stock"], $row["description"], $row["created_at"], $row["color"], $row["franchise"], $row["theme"]);
                    break;
                }
                case "game": {
                    return new Game($row["id"], $row["name"], $row["price"], $row["in_stock"], $row["description"], $row["created_at"], $row["color"], $row["age"], $row["platform"], $row["genre"]);
                    break;
                }
                default: {
                    echo "Unknown category";
                }
            }

        }
            
        return $products;
        }
    }

    public static function deleteProductById($id)
  {
    $sql = "DELETE FROM `product` WHERE `product`.`id` = $id";

    $result = mysqli_query(self::$conn, $sql);

    return $result;
  }

    public static function createOrder($order)
  {

    $sql = "INSERT INTO `webshop-order` (`email`, `name`, `address`, `total`) VALUES ('{$order->email}', '{$order->name}', '{$order->address}', '{$order->total}'); ";

    $result = mysqli_query(self::$conn, $sql);

    return $result;
  }

  public static function getAllOrders()
  {
    $sql = "SELECT * FROM `webshop-order`;";

    $result = mysqli_query(self::$conn, $sql);

    $orders = [];

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = new WebshopOrder($row["id"], $row["email"], $row["name"], $row["address"], $row["total"], $row["date"]);
      }
    }

    return $orders;
  }

  public static function deleteOrderById($id)
  {
    $sql = "DELETE FROM `webshop-order` WHERE `webshop-order`.`id` = $id;";

    $result = mysqli_query(self::$conn, $sql);

    return $result;
  }
  

    private static function boolToSQL($bool) {
        if($bool == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
?>