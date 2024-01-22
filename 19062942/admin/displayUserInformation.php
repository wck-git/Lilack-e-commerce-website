<?php
    require_once "../includes/dbController.php";
    $db_handler = new DBController();
    echo "<h2>User Information</h2>";

    $query = $db_handler->getConn()->prepare("SELECT * FROM user, userRole WHERE user.userRoleID = userRole.userRoleID ORDER BY user.userRoleID, user.userID ASC");
    $query->execute();
    $result = $query->get_result();
    if (!empty($result)) { 
      echo "<table>";
        echo "<thead>";
          echo "<th>ID</th>";
          echo "<th>Name</th>";
          echo "<th>Email</th>";
          echo "<th>Role</th>";
          echo "<th>Remove</th>";
        echo "</thead>";
      
      // DISPLAY USER INFORMATION 
      while($user_array = $result->fetch_assoc()){
        echo "<tbody>";
          echo "<td>" . $user_array['userID'] . "</td>";
          echo "<td>" . $user_array['userFirstName'] . $user_array['userLastName'] . "</td>";
          echo "<td>" . $user_array['userEmail'] . "</td>";
          echo "<td>" . $user_array['userRoleName'] . "</td>";
          if ($user_array['userRoleName'] == "admin"){
            echo "<td style='text-align: center;'>-</td>";
          }
          else{
            echo "<td style='text-align:center;'><a href='admin/adminControls.php?removeUser=" . $user_array['userID'] . "userRoleName=" . $user_array['userRoleName'] . "'>
            <i class='fas fa-trash-alt icon'></i></a></td>";
          }
        echo "</tbody>";
      }
    echo "</table>";
    }
?>

