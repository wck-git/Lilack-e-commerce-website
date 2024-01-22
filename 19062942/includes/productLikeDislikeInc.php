<?php
require_once "dbController.php";
$db_handler = new DBController();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
}
$previousPage = $_SERVER["HTTP_REFERER"];
$productID = $_GET['productID'];

if (isset($_POST['like'])){
    if (isset($_SESSION['userID'])){
        // check if user has already liked or dislike the products
        $action = checkRating();
        if ($action == "like"){
            removeLike();
            echo "like removed";
        }
        elseif ($action == "dislike"){
            removeDislike();
            addLike();
            echo "dislike removed and like added";
        }
        else{
            addLike();
            echo "like added";
        }
    }
    else{
        $_SESSION['loginError'] = "Please log in to rate the product";
    }
    header("location: " . $previousPage);
}

if (isset($_POST['dislike'])){
    if (isset($_SESSION['userID'])){
        // check if user has already liked or dislike the products
        $action = checkRating();
        if ($action == "like"){
            removeLike();
            addDislike();
            echo "like removed and dislike added";
        }
        elseif ($action == "dislike"){
            removeDislike();
            echo "dislike removed";
        }
        else{
            addDislike();
            echo "dislike added";
        }
    }
    else{
        $_SESSION['loginError'] = "Please log in to rate the product";
    }
    header("location: " . $previousPage);
}


function displayLike(){
    global $db_handler, $productID;
    $query = $db_handler->getConn()->prepare("SELECT * FROM productlikes WHERE productID = ? AND ratingAction = 'like'");
    $query->bind_param("d", $productID);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    $rowCount = $result->num_rows;
    echo $rowCount;
}

function displayDislike(){
    global $db_handler, $productID;
    $query = $db_handler->getConn()->prepare("SELECT * FROM productlikes WHERE productID = ? AND ratingAction = 'dislike'");
    $query->bind_param("d", $productID);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    $rowCount = $result->num_rows;
    echo $rowCount;
}

function checkRating(){
    global $db_handler, $userID, $productID;
    $query = $db_handler->getConn()->prepare("SELECT * FROM productlikes WHERE productID = ? AND userID = ?");
    $query->bind_param("dd", $productID, $userID);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    $rowCount = $result->num_rows;
    if ($rowCount > 0){
        while ($row = $result->fetch_assoc()){
            $action = $row['ratingAction'];
        }
        return $action;
    }
    else{
        return "";
    }
}

function addLike(){
    global $db_handler, $userID, $productID;
    $action = $_POST['like'];
    $query = $db_handler->getConn()->prepare("INSERT INTO productlikes VALUES(?,?,?)");
    $query->bind_param("dds", $productID, $userID, $action);
    $query->execute();
    $result = $query->get_result();
    $query->close();
}

function addDislike(){
    global $db_handler, $userID, $productID;
    $action = $_POST['dislike'];
    $query = $db_handler->getConn()->prepare("INSERT INTO productlikes VALUES(?,?,?)");
    $query->bind_param("dds", $productID, $userID, $action);
    $query->execute();
    $result = $query->get_result();
    $query->close();
}

function removeLike(){
    global $db_handler, $userID, $productID;
    $query = $db_handler->getConn()->prepare("DELETE FROM productlikes WHERE productID = ? AND userID = ?");
    $query->bind_param("dd", $productID, $userID);
    $query->execute();
    $query->close();
}

function removeDislike(){
    global $db_handler, $userID, $productID;
    $query = $db_handler->getConn()->prepare("DELETE FROM productlikes WHERE productID = ? AND userID = ?");
    $query->bind_param("dd", $productID, $userID);
    $query->execute();
    $query->close();
}
?>