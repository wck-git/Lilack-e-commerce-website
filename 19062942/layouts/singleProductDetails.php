<?php
    require_once "includes/dbController.php";
    $db_handler = new DBController();

    echo "<div class='productFlex'>";
    $query = $db_handler->getConn()->prepare("SELECT * FROM products WHERE productID = ?");
    $query->bind_param('s', $productID);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    // LOAD PRODUCT INFORMATION
    while ($row = $result->fetch_assoc()){
        echo "<div class='productImageContainer'>";
            echo "<img src='$row[productImage]' alt='$row[productName]' class='singleProductImage'>";
        echo "</div>";
        echo "<div class='productDetails'>";
        echo "<h2>" . $row['productName'] . "</h2>";
        echo "<span class='price'>RM " . number_format($row['productPrice'],2) . "</span>";
    }
        echo" <form action='includes/productLikeDislikeInc.php?productID=$productID'  class='likeDislikeForm' method='post'>" ?>
            <!-- like -->
            <div class="likeContainer">
                <button type="submit" name="like" value="like">
                    <?php
                        $action = checkRating();
                        if ($action == "like"){ ?>
                            <i class="far fa-thumbs-up icon" style="color: blue;"></i>
                        <?php }
                        else{
                            echo "<i class='far fa-thumbs-up icon'></i>";
                        }
                        displayLike();
                    ?>
                </button>
            </div>
            <!-- dislike -->
            <div class="dislikeContainer">
                <button type="submit" name="dislike" value="dislike">
                    <?php
                        $action = checkRating();
                        if ($action == "dislike"){ ?>
                            <i class="far fa-thumbs-down icon" style="color: blue;"></i>
                        <?php }
                        else{
                            echo "<i class='far fa-thumbs-down icon'></i>";
                        }
                        displayDislike();
                    ?>
                </button>
            </div>
        </form>
        <span>
            <?php
                if (isset($_SESSION['loginError'])){
                    echo "<span class='errorMessages'>" . $_SESSION['loginError'] . "</span>";
                    unset($_SESSION['loginError']);
                }
                ?>
        </span>
        <?php
        if (isset($_SESSION['userRoleID'])){ 
            echo "<form action='includes/shoppingCartInc.php?productID=$productID' method='post'>";
            ?>
            <span>Quantity: </span>
            <input type="number" name="productQuantity" value="1" min="1" style="max-width: 50px;"><br><br>
            <button type="submit" name="addToCart" class="productDetailsBtn">
                <i class="fas fa-shopping-cart icon"></i>
                <span>Add to Cart</span>
            </button>
            </form>
        <?php
            if (isset($_SESSION['addedToCartMessage'])){
                echo $_SESSION['addedToCartMessage'];
                unset($_SESSION['addedToCartMessage']);
            }
            else if (isset($_SESSION['failedAddCartMessage'])){
                echo $_SESSION['failedAddCartMessage'];
                unset($_SESSION['failedAddCartMessage']);
            }
        } else{
            echo "<a href='login.php' class='productDetailsBtn'>Please log in to purchase the product</a>";
        }
        ?>
        
    </div>
</div>