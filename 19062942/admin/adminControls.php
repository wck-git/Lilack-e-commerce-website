<?php
require_once "../includes/dbController.php";
$db_handler = new DBController();

$productImage = sanitise($db_handler->getConn(), $_POST['productImage']);
$productName = sanitise($db_handler->getConn(), $_POST['productName']);
$productTypeID = sanitise($db_handler->getConn(), $_POST['productTypeID']);
$productCategoryID = sanitise($db_handler->getConn(), $_POST['productCategoryID']);
$productPrice = sanitise($db_handler->getConn(), $_POST['productPrice']);
$productID = sanitise($db_handler->getConn(), $_POST['productID']);

// remove user
if (!empty($_GET['removeUser']) && isset($_GET['removeUser'])){
    if (!$_GET['userRoleName'] == "admin"){
        removeUser();
        header("location: ../profile.php");
    }
}

// remove product
if (!empty($_GET['removeProduct']) && isset($_GET['removeProduct'])){
    removeProduct();
    header("location: ../profile.php");
}

// add product
if (isset($_POST['addProduct'])){
    addProducts();
    header("location: ../profile.php");
}

// edit product details
if (isset($_POST['updateProduct'])){
    editProductDetails();
    header("location: ../profile.php");
}


function removeUser(){
    global $db_handler;
    $userID = $_GET["removeUser"];
    $query = $db_handler->getConn()->prepare("DELETE FROM user WHERE userID = ?");
    $query->bind_param('d', $userID);
    $query->execute();
    $query->close();
}

function removeProduct(){
    global $db_handler;
    $productID = $_GET["removeProduct"];
    $query = $db_handler->getConn()->prepare("DELETE FROM products WHERE productID = ?");
    $query->bind_param('d', $productID);
    $query->execute();
    $query->close();
}

function editProductDetails(){
    global $db_handler, $productImage, $productName, $productPrice, $productID;
    $query = $db_handler->getConn()->prepare("UPDATE products SET productName = ?, productImage = ?, productPrice = ? WHERE productID = ?");
    $query->bind_param('ssdd', $productName, $productImage, $productPrice, $productID);
    $query->execute();
    $query->close();
}

function addProducts(){
    global $db_handler, $productImage, $productName, $productTypeID, $productCategoryID, $productPrice;
    $query = $db_handler->getConn()->prepare("INSERT INTO products (productID, productImage, productName, productTypeID, productCategoryID, productPrice) VALUES (NULL,?,?,?,?,?)");
    $query->bind_param('ssssd', $productImage, $productName, $productTypeID, $productCategoryID, $productPrice);
    $query->execute();
    $query->close();

    // set the forumID same as productID
    $query = $db_handler->getConn()->prepare("UPDATE products SET forumID = (SELECT MAX(productID) FROM products) ORDER BY productID DESC LIMIT 1");
    $query->execute();
    $query->close();
}

// sanitise
function sanitise($db_handler, $str){
    return htmlentities(mysql_fix_string($db_handler, $str)); // convert the text to html entities
}

function mysql_fix_string($db_handler, $str){
    $str = strip_tags($str); //strip tags
    $str = stripslashes($str); // remove backslahses
    return $db_handler->real_escape_string($str); // remove special characters
}
?>