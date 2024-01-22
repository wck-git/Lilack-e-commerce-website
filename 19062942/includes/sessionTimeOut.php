<?php
    session_set_cookie_params(0); // set the cookie to change the expiration time to 0
    session_start();

    if (isset($_SESSION['userID'])){
        if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > (60*15))) { // 15 minutes
            destroy_session_and_data();
            header ("location: index.php");
        }
        $_SESSION['lastActivity'] = time(); // update last activity time stamp
    }

    function destroy_session_and_data(){
        session_unset(); // frees all session variables
        setcookie(session_name(), '',   time() - 2592000, '/');
        session_destroy();
    }
?>