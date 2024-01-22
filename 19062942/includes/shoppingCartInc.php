<?php
require_once "dbController.php";
$db_handler = new DBController();
session_start();

$cart = $_SESSION['userID'];
$previousPage = $_SERVER["HTTP_REFERER"];

// add product to cart
if (isset($_POST['addToCart'])){
    // check if the product has been added to the cart yet
    $rowCount = checkProductInCart();

    // if the product is already in the cart, the quantity in the cart will increase with the new amount
    if ($rowCount == 1){
        increaseProductInCart();
    }
    // if the product is not in the cart, the product will be added to the cart
    else{
        addProductToCart();
    }
}

// remove product in cart
if (!empty($_GET['removeProductInCart']) && isset($_GET['removeProductInCart'])){
    removeSingleProductFromCart();
    header("location: ../shoppingCart.php");
}

// empty all products in cart
if (!empty($_GET['removeAllProductsInCart']) && isset($_GET['removeAllProductsInCart'])){
    emptyCart();
    header("location: ../shoppingCart.php");
}

function checkProductInCart(){
    global $db_handler, $cart;
    $productID = $_GET['productID'];
    $query = $db_handler->getConn()->prepare("SELECT * FROM cartproduct WHERE cartID = ? AND productID = ?");
    $query->bind_param('dd', $cart, $productID);
    $query->execute();
    $result = $query->get_result();
    $rowCount = $result->num_rows;
    $query->close();
    return $rowCount;
}

function increaseProductInCart(){
    global $db_handler, $cart, $previousPage;
    $productID = $_GET['productID'];
    $quantity = $_POST['productQuantity'];
    if ($quantity > 0){
        $query = $db_handler->getConn()->prepare("UPDATE cartproduct SET quantity = quantity + ? WHERE cartID = ? AND productID = ?");
        $query->bind_param('ddd', $quantity, $cart, $productID);
        $query->execute();
        $query->close();
        $_SESSION['addedToCartMessage'] = "The product has succesfully been added to your cart";
    }
    else{
        $_SESSION['failedAddCartMessage'] = "Please enter at least 1 quantity to be added to the cart";
    }
    
    header("location: " . $previousPage);

}

function addProductToCart(){
    global $db_handler, $cart, $previousPage;
    $productID = $_GET['productID'];
    $quantity = $_POST['productQuantity'];
    if ($quantity > 0){
        $query = $db_handler->getConn()->prepare("INSERT INTO cartproduct VALUES (?,?,?)");
        $query->bind_param('ddd', $cart , $productID , $quantity);
        $query->execute();
        $query->close();
        $_SESSION['addedToCartMessage'] = "The product has succesfully been added to your cart";
    }
    else{
        $_SESSION['failedAddCartMessage'] = "Please enter at least 1 quantity to be added to the cart";
    }
    header("location: " . $previousPage);
    
}

function removeSingleProductFromCart(){
    global $db_handler, $cart;
    $productID = $_GET['removeProductInCart'];
    $query = $db_handler->getConn()->prepare("DELETE FROM cartproduct WHERE cartproduct.cartID = ? AND cartproduct.productID = ?;");
    $query->bind_param('dd', $cart, $productID);
    $query->execute();
    $query->close();
}

function emptyCart(){
    global $db_handler, $cart;
    $query = $db_handler->getConn()->prepare("DELETE FROM cartproduct WHERE cartproduct.cartID = ?;");
    $query->bind_param('d', $cart);
    $query->execute();
    $query->close();
}

?>