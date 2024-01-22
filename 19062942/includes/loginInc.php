<?php 

if (isset($_POST['submit'])){
    session_start();
    require_once 'dbController.php';
    $db_handler = new DBController();

    // connection checker
    if ($db_handler->getConn()->connect_error) {
		die("Connection failed: " . $db_handler->getConn()->connect_error);
	}

    if(empty($_POST['email']) && empty($_POST['pwd'])){
        $_SESSION['requiredError'] = "Please enter email and password";
        header("location: ../login.php");
    }
    else{
        $emailTemp = sanitise($db_handler->getConn(), $_POST['email']);
        $passwordTemp = sanitise($db_handler->getConn(), $_POST['pwd']);

        $query = $db_handler->getConn()->prepare("SELECT * FROM user WHERE userEmail = ?");
        $query->bind_param('s', $emailTemp);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        $rowCount = $result->num_rows;

        // username and password validation
        if ($rowCount == 1){
            // obtain the data from the databse
            while($row= $result->fetch_assoc()) {
                $userID = $row['userID'];
                $userFirstName  = $row['userFirstName'];
                $pw  = $row['userLoginPassword']; // manually inserted data in the database can't be verified as it is not hashed
                $userRoleID = $row['userRoleID'];
            }
            if (password_verify($passwordTemp, $pw)){
                // set session variables
                $_SESSION['userID'] = $userID;
                $_SESSION['userFirstName'] = $userFirstName;
                $_SESSION['userRoleID'] = $userRoleID;
                header("location: ../index.php");
            }
            else{
                $_SESSION['loginError'] = "Invalid username or password";
                header("location: ../login.php");
            }
        }
        else{
            $_SESSION['loginError'] = "Invalid username or password";
            header("location: ../login.php");
        }
    }
}
else{
    header("location: ../login.php");
}

// sanitise
function sanitise($db_handler, $str){
    return htmlentities(mysql_fix_string($db_handler, $str)); // convert the text to html entities
}

function mysql_fix_string($db_handler, $str){
    $str = strip_tags($str); // strip tag
    $str = trim($str); // trim
    $str = stripslashes($str); // remove backslahses
    return $db_handler->real_escape_string($str); // remove special characters
}

?>