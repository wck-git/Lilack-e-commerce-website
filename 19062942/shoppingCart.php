<?php 
require_once "includes/sessionTimeOut.php";
require_once "includes/dbController.php";
$db_handler = new DBController();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lilack</title>
    <link rel="stylesheet" href="css/shoppingCart.css" />
  </head>
  <style>
  </style>
  <body>
    <?php require_once "layouts/header.php" ?>

    <main>
      <section class="container">
        <h2 class="categoryTitle">Shopping Cart</h2>
        <div class="cartDetails">
          <?php 
          if (isset($_SESSION['userID'])){
            $cart =  $_SESSION['userID'];
          }
          
          $query = $db_handler->getConn()->prepare("SELECT * FROM cartProduct, products WHERE cartProduct.productID = products.productID AND cartID = ?");
          $query->bind_param("d", $cart);
          $query->execute();
          $result = $query->get_result();
          $query->close();
          $rowCount = $result->num_rows;

          if ($rowCount > 0) {
            echo "<div class='emptyCartBtnContainer'><a href='includes/shoppingCartInc.php?removeAllProductsInCart=true' class='emptyCartBtn btn'>Empty Cart</a></div>";
            echo "<div class='cartTitle'>";
            echo "<h3>Remove</h3>";
            echo "<h3>Product</h3>";
            echo "<h3>Unit Price</h3>";
            echo "<h3>Quantity</h3>";
            echo "<h3>Unit Total</h3>";
            echo "</div>";
            $totalProductPrice = 0;
            while($product_array = $result->fetch_assoc()){ 
                $productImageUrl = $product_array['productImage'];
          ?>
          <div class="cartItems">
              <div class="cartRemove">
                <?php echo "<a href='includes/shoppingCartInc.php?removeProductInCart=" . $product_array['productID'] . "'>
                  <i class='fas fa-trash-alt icon'></i></a>";?>
              </div>
              <div class="cartProduct">
                <?php echo "<img src='$productImageUrl' class='productImage'>";?>
                <?php echo "<span>" . $product_array['productName'] . "</span>";?>
              </div>
              <div class="unitPrice">
                <?php echo "<span>RM " . number_format($product_array['productPrice'],2) . "</span>";?>
              </div>
              <div class="unitQuantity">
              <?php echo "<span>" . $product_array['quantity'] . "</span>";?>
              </div>
              <div class="unitTotal">
                <?php 
                  $totalProductPrice += ($product_array['productPrice'] * $product_array['quantity']);
                  echo "<span> RM" . number_format(($product_array['productPrice'] * $product_array['quantity']),2) . "</span>";
                ?>
              </div>
            </div>
            <?php
              }
            }
            else{
              echo "<div class='emptyCartContainer'>";
              echo "<div>";
              echo "<i class='fas fa-shopping-cart icon' id='emptyCart'></i>";
              echo "</div>";
              echo"<p>Oh no! Your cart is empty</p>";
              echo "</div>";
            }
            ?>
        </div>
      </section>

      <!-- ORDER SUMMARY -->
      <?php 
        if ($rowCount > 0){
          $shippingFee = 6;
          $totalAmountPayable = $shippingFee + $totalProductPrice; ?>
          <section class="container">
            <div class="orderSummary">
              <h2>Order Summary</h2>
              <div class="orderSubtotal">
                  <h3>Subtotal</h3>
                  <span><?php echo "RM " . number_format($totalProductPrice, 2) ;?></span>
              </div>
              <div class="orderShippingFees">
                  <h3>Shipping</h3>
                  <span><?php echo "RM " . number_format($shippingFee, 2) ;?></span>
              </div>
              <div class="orderTotalFees">
                  <h3>Total</h3>
                  <span><?php echo "RM " . number_format($totalAmountPayable, 2) ;?></span>
              </div>
              <div class="checkoutBtnContainer">
                <a href="checkout.php" class="btn checkoutBtn">Checkout</a>
              </div>
            </div>
          </section>
        <?php
        }
      ?>
        
      
    </main>

    <?php require_once "layouts/footer.php" ?>
  </body>
</html>
