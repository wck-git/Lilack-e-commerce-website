<?php
if (isset($_POST['userSubmit']) || isset($_POST['adminSubmit'])){
	session_start();
	require_once "dbController.php";
	$db_handler = new DBController();

	// connection checker
	if ($db_handler->getConn()->connect_error) {
		die("Connection failed: " . $cb_handler->getConn()->connect_error);
	}

	// obtain input
	if ((empty($_POST['firstName'])) || (empty($_POST['lastName'])) || (empty($_POST['email'])) || (empty($_POST['pwd'])) || (empty($_POST['rePwd']))){
		$_SESSION['requiredError'] = "Please enter the required field";
		if (isset($_POST['userSubmit'])){
			header("location: ../signUp.php");
		}
		elseif (isset($_POST['adminSubmit'])){
			header("location: ../profile.php");
		}
	}
	else{
		// sanitisation of all inputs
		$firstName = sanitise($db_handler->getConn(), $_POST['firstName']);
		$lastName = sanitise($db_handler->getConn(), $_POST['lastName']);
		$email = sanitise($db_handler->getConn(), $_POST['email']);
		$password = sanitise($db_handler->getConn(), $_POST['pwd']);
		$password = password_hash($password, PASSWORD_DEFAULT);
		$rePassword = sanitise($db_handler->getConn(), $_POST['rePwd']);
		$rePassword = password_hash($rePassword, PASSWORD_DEFAULT);
		if (isset($_POST['userRole'])){
			$userRole = $_POST['userRole'];
		}
		
		$validation = dataValidation($_POST['firstName'], '/^[a-zA-Z ]{1,16}$/');
		$validation .= dataValidation($_POST['lastName'], '/^[a-zA-Z ]{1,16}$/');
		$validation .= dataValidation($_POST['email'],  "/^([a-z0-9\+_\-])*@([a-z0-9\-]+\.)+[a-z]{2,6}$/");
		$validation .= dataValidation($_POST['pwd'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/');
		$validation .= dataValidation($_POST['rePwd'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/');
		$validationArray = str_split($validation);

		$arraySize = count($validationArray) + 1;
		for ($x = 0; $x < $arraySize; $x++){
			// first name error
			if ($x == 0){
				if ($validationArray[$x] == "a"){
					$_SESSION['firstNameError'] = "First Name must contain 1 to 16 letters only";
					break;
				}
			}
			// last name error
			elseif ($x == 1){
				if ($validationArray[$x] == "a"){
					$_SESSION['lastNameError'] = "Last Name contain 1 to 16 letters only";
					break;
				}
			}
			// email error	
			elseif ($x == 2){
				if ($validationArray[$x] == "a"){
					$_SESSION['emailError'] = "Please enter a valid email";
					break;
				}
				elseif ($validationArray[$x]  == "x"){
					$user = $db_handler->getConn()->prepare("SELECT userEmail FROM user WHERE userEmail = ?");
					$user->bind_param("s", $email);
					$user->execute();
					$result = $user->get_result();
					$result = $result->num_rows;
					if ($result == 1){
						$_SESSION['duplicateEmailError'] = "The email address has already taken before";
						$validation[$x] = "a";
						header("location: ../signUp.php");
						break;
					}
				}
			}
			// password error
			elseif ($x == 3){
				if (($validationArray[$x]  == "a")){
					$_SESSION['passwordError'] = "Password must contain 6-12 characters with at least have one letter, at least one number";
					break;
				}
			}
			// re-enter password error
			elseif ($x == 4){
				if (($validationArray[$x]  == "a")){
					$_SESSION['rePasswordError'] = "Please enter the same password correctly";
					break;
				}
				elseif ($validationArray[$x] == "x"){
					if ($_POST['pwd'] != $_POST['rePwd']){
						$_SESSION['rePasswordError'] = "Please enter the same password correctly";
						$validation[$x] = "a";
						break;
					}
				}
			}
			// user role error
			elseif ($x == 5){
				if (isset($_POST['adminSubmit'])){
					if ($_POST['userRole'] == 0){
						$_SESSION['userRoleError'] = "Please select the selected role";
						header("location: ../profile.php");
					}
					else{
						$validation.= "x";
					}
				}
			}
		}

		// insert data
		if (isset($_POST['adminSubmit'])){
			if ($validation == "xxxxxx"){
				$query = $db_handler->getConn()->prepare("INSERT INTO user (userID, userRoleID, userFirstName, userLastName, userEmail, userLoginPassword) VALUES (NULL,?,?,?,?,?)");
				$query->bind_param('dssss', $userRole, $firstName, $lastName, $email, $password);
				$query->execute();
				$query->close();
				$_SESSION['signUpSuccessMessage'] = "You have created an account successfully";

				// setting the cartID same as userID
				$query = $db_handler->getConn()->prepare("UPDATE user SET cartID = (SELECT MAX(userID) FROM user) ORDER BY userID DESC LIMIT 1");
				$query->execute();
				$query->close();
				header("location: ../profile.php");
			}
			else{
				header("location: ../profile.php");
			}
		}
		else if (isset($_POST['userSubmit'])){
			if ($validation == "xxxxx"){
				$query = $db_handler->getConn()->prepare("INSERT INTO user (userID, userRoleID, userFirstName, userLastName, userEmail, userLoginPassword) VALUES (NULL,3,?,?,?,?)");
				$query->bind_param('ssss', $firstName, $lastName, $email, $password);
				$query->execute();
				$query->close();
				$_SESSION['signUpSuccessMessage'] = "You have created an account successfully";

				// setting the cartID same as userID
				$query = $db_handler->getConn()->prepare("UPDATE user SET cartID = (SELECT MAX(userID) FROM user) ORDER BY userID DESC LIMIT 1");
				$query->execute();
				$query->close();
				header("location: ../signUp.php");
			}
			else{
				header("location: ../signUp.php");
			}
		}
		// echo $validation; // debug
	}
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

// regEx pattern matching
function dataValidation($data, $data_pattern){
	if (preg_match($data_pattern, $data)) {
		return "x"; 
	}
	else{
		return "a";
	}
}
?>