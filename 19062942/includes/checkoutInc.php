<?php
if (isset($_POST['confirmPayment'])){
    require_once "dbController.php";
    $db_handler = new DBController();
    session_start();
    $userID = $_SESSION['userID'];

    if (empty($_POST['contactNumber']) || empty($_POST['address']) || empty($_POST['postcode']) || empty($_POST['city']) || empty($_POST['state'])){
        $_SESSION['deliveryRequiredMessage'] = "Please fill in the delivery form";
        header("location: ../checkout.php");
    }
    else{
        if (empty($_POST['cardNumber']) || empty($_POST['cardSecurityNumber']) || empty($_POST['expirationMonth']) || empty($_POST['expirationYear'])){
            $_SESSION['paymentRequiredMessage'] = "Please fill in the payment form";
            header("location: ../checkout.php");
        }
        else{
            // SANITISE
            $contactNumber = sanitise($db_handler->getConn(), $_POST['contactNumber']);
            $address = sanitise($db_handler->getConn(), $_POST['address']);
            $postcode = sanitise($db_handler->getConn(), $_POST['postcode']);
            $city = sanitise($db_handler->getConn(), $_POST['city']);
            $state = sanitise($db_handler->getConn(), $_POST['state']);

            $cardNumber = sanitise($db_handler->getConn(), $_POST['cardNumber']);
            $cardSecurityNumber = sanitise($db_handler->getConn(), $_POST['cardSecurityNumber']);
            $expirationMonth = sanitise($db_handler->getConn(), $_POST['expirationMonth']);
            $expirationYear = sanitise($db_handler->getConn(), $_POST['expirationYear']);

            // DELIVERY VALIDATION
            $validation = dataValidation($_POST['contactNumber'], '/^\d{9,11}$/'); // allows only digits 9 to 11 characters long
            $validation .= dataValidation($_POST['address'], '/^[\s\S]{5,40}$/');  // allows all characters 5 to 40 characters long
            $validation .= dataValidation($_POST['postcode'], '/^\d{5}$/');  //allows only 5 digits
            $validation .= dataValidation($_POST['city'], '/^[a-zA-Z ]{4,30}$/'); // allows only letters 4 to 30 characters long
            $validation .= dataValidation($_POST['state'], '/^[a-zA-Z ]{4,30}$/'); // allows only letters 4 to 30 characters long
            
            // PAYMENT VALIDATION
            $validation .= dataValidation($_POST['cardNumber'], '/^\d{16}$/'); //allows only 16 digits
            $validation .= dataValidation($_POST['cardSecurityNumber'], '/^\d{3}$/'); //allows only 3 digits
            $validation .= dataValidation($_POST['expirationMonth'], '/^\d{2}$/');  //allows only 2 digits
            $validation .= dataValidation($_POST['expirationYear'], '/^\d{2}$/'); //allows only 2 digits
            $validationArray = str_split($validation);

            
            $arraySize = count($validationArray);
            for ($x = 0; $x < $arraySize; $x++){
                if ($x == 0){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['deliveryContactNumberError'] = "Please enter a valid contact number. e.g. [0123456789]";
                        break;
                    }
                }
                if ($x == 1){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['deliveryAddressError'] = "Please enter a valid address. e.g. [1, Jalan SS 1/1]";
                        break;
                    }
                }
                if ($x == 2){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['deliveryPostcodeError'] = "Please enter a valid postcode. e.g. [44444]";
                        break;
                    }
                }
                if ($x == 3){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['deliveryCityError'] = "Please enter a valid city. e.g. [Petaling Jaya]";
                        break;
                    }
                }
                if ($x == 4){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['deliveryStateError'] = "Please enter a valid state. e.g. [Selangor]";
                        break;
                    }
                }
                if ($x == 5){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['cardNumberError'] = "Please enter a valid card number. e.g. [1234123412341234]";
                        break;
                    }
                }
                if ($x == 6){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['cardSecurityNumberError'] = "Please enter a valid card security number. e.g. [000]";
                        break;
                    }
                }
                if ($x == 7){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['expirationMonthError'] = "Please enter a valid card expiration month. e.g. [01]";
                        break;
                    }
                }
                if ($x == 8){
                    if (($validationArray[$x] == "a")){
                        $_SESSION['expirationYearError'] = "Please enter a valid card expiration year. e.g. [22]";
                        break;
                    }
                }
            }

            if ($validation == str_repeat("x", $arraySize)){
                deleteCartProductItems();
                header("location: ../paymentSuccess.php");
            }
            else{
                header("location: ../checkout.php");
            }
        }
    }
}

function sanitise($db_handler, $str){
    return htmlentities(mysql_fix_string($db_handler, $str)); // convert the text to html entities
}

function mysql_fix_string($db_handler, $str){
    $str = strip_tags($str); //strip tags
    $str = stripslashes($str); // remove backslahses
    return $db_handler->real_escape_string($str); // remove special characters
}

function dataValidation($data, $data_pattern){
    if (preg_match($data_pattern, $data)) {
        return "x"; 
    }
    else{
        return "a";
    }
}

function deleteCartProductItems(){
    global $db_handler, $userID;
    $query = $db_handler->getConn()->prepare("DELETE FROM cartproduct WHERE cartID = ?");
    $query->bind_param("d", $userID);
    $query->execute();
    $query->close();
}

?>