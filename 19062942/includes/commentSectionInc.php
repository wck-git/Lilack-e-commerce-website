<?php
session_start();

require_once "dbController.php";
$db_handler = new DBController();
$userID = $_SESSION['userID'];
$previousPage = $_SERVER["HTTP_REFERER"];

// add comment
if (isset($_POST['submit'])){
    addComment();
    header("location: " . $previousPage);
}

// remove comment
if (isset($_GET['removeComment'])){
    deleteComment();
    header("location: " . $previousPage);
}

function addComment(){
    global $db_handler, $userID;
    $productID = $_GET['productID'];
    $comment = sanitise($db_handler->getConn(), $_POST['comment']);

    // comment
    $query = $db_handler->getConn()->prepare("INSERT INTO comment VALUES(NULL,?,?,?,CURRENT_TIMESTAMP)");
    $query->bind_param("dds", $productID, $userID, $comment);
    $query->execute();
    $query->close();
}

function deleteComment(){
    global $db_handler;
    $commentID = $_GET['removeComment'];
    $query = $db_handler->getConn()->prepare("DELETE FROM comment WHERE commentID = ?;");
    $query->bind_param('d', $commentID);
    $query->execute();
    $query->close();
}

function sanitise($db_handler, $str){
	return htmlentities(mysql_fix_string($db_handler, $str)); // convert the text to html entities
}

function mysql_fix_string($db_handler, $str){
	$str = strip_tags($str); //strip tags
	return $db_handler->real_escape_string($str); // remove special characters
}

?>