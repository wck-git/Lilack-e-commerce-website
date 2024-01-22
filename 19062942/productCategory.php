<?php 
require_once "includes/sessionTimeOut.php";
require_once "includes/dbController.php";
$db_handler = new DBController();
$productCategoryID = $_GET['productCategoryID'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/breadCrumb.css" />
    <link rel="stylesheet" href="css/productCategories.css" />
</head>
<body>
    <?php require_once "layouts/header.php"; ?>

    <main>
      <section class="container">
        <div class="breadCrumbTrail">
          <ul>
            <li><a href="index.php">Home</a></li>
              <?php 
                $query = $db_handler->getConn()->prepare("SELECT * FROM products, productCategory WHERE products.productCategoryID AND productCategory.productCategoryID AND productCategory.productCategoryID = ?");
                $query->bind_param("d", $productCategoryID);
                $query->execute();
                $result = $query->get_result();
                $query->close();
                $product_array= $result->fetch_assoc();
                echo "<li><a href='#'>$product_array[productCategory]</a></li>";
              ?>
            </a></li>
          </ul>
        </div>
      </section>

      <section class="container">
          <?php 
          echo "<h2 class='categoryTitle'>$product_array[productCategory]</h2>";

            echo "<div class='products'>";

            $query = $db_handler->getConn()->prepare("SELECT * FROM products WHERE productCategoryID = ? ORDER BY productID ASC");
            $query->bind_param("d", $productCategoryID);
            $query->execute();
            $result = $query->get_result();
            $query->close();
            if (!empty($result)) { 
                while($product_array = $result->fetch_assoc()){
                    $productID = $product_array['productID'];
                    $productImageUrl = $product_array['productImage'];
                    $productName = $product_array['productName'];
        
                    echo "<a href='singleProduct.php?productID=$productID' class='product'>";
                    echo "<img src='$productImageUrl' class='productImage'>";
                    echo "<h3>" . $productName . "</h3>";
                    echo "<span>RM " . number_format($product_array['productPrice'],2) . "</span>";
                    echo "</a>";
                }
            }
            echo "</div>";
          ?>
      </section>
    </main>

    <?php require_once "layouts/footer.php"; ?>
</body>
</html>