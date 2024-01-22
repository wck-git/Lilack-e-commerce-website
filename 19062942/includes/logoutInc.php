<?php // continue.php
    session_start();

    if (isset($_POST['logout'])){
        if (isset($_SESSION['userID'])){
            destroy_session_and_data();
            header("location: ../index.php");
        }
    }

    function destroy_session_and_data(){
        session_unset();
        setcookie(session_name(), '', time() - 2592000, '/');
        session_destroy();
    }
?>