<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<div class="signUpForm">
  <h2 class="categoryTitle">Sign Up</h2>
  <form action="includes/signUpInc.php" method="POST">
      <fieldset>
        <!-- First Name -->
        <label for="">First Name</label>
        <input type="text" name="firstName" placeholder="First Name...">
        <span>
          <?php 
          if (isset($_SESSION['firstNameError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['firstNameError'] . "</span>";
            unset($_SESSION['firstNameError']); 
          }
          ?>
        </span>
        <!-- Last Name -->
        <label for="">Last Name</label>
        <input type="text" name="lastName" placeholder="Last Name...">
        <span>
          <?php 
          if (isset($_SESSION['lastNameError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['lastNameError'] . "</span>";
            unset($_SESSION['lastNameError']);  
          }
          ?>
        </span>
        <!-- Email -->
        <label for="">Email</label>
        <input type="text" name="email" placeholder="Email...">
        <span>
          <?php 
          if (isset($_SESSION['emailError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['emailError'] . "</span>";
            unset($_SESSION['emailError']);
          }
          if (isset($_SESSION['duplicateEmailError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['duplicateEmailError'] . "</span>"; 
            unset($_SESSION['duplicateEmailError']);
          }
          ?>
        </span>
        <!-- Password -->
        <label for="">Password</label>
        <input type="password" name="pwd" id="" placeholder="Password...">
        <span>
          <?php 
          if (isset($_SESSION['passwordError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['passwordError'] . "</span>";
            unset($_SESSION['passwordError']);
          }
          ?>
        </span>
        <!-- Re-enter Password -->
        <label for="">Re-enter Password</label>
        <input type="password" name="rePwd" id="" placeholder="Re-enter Password...">
        <span>
          <?php 
          if (isset($_SESSION['rePasswordError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['rePasswordError'] . "</span>";
            unset($_SESSION['rePasswordError']);
          }
          ?>
        </span>
        <!-- Role -->
        <?php 
          if (isset($_SESSION['userRoleID']) && $_SESSION['userRoleID'] != 3){ ?>
              <label for="">Role:</label>
              <select name="userRole">
                  <option value="0">Select</option>
                  <?php if ($_SESSION['userRoleID'] == 1) echo "<option value='1'>Admin</option>;"?>
                  <option value="2">Editor</option>
                  <option value="3">User</option>
              </select>
              <span>
              <?php
                  if (isset($_SESSION['userRoleError'])){ 
                      echo "<span class='errorMessages'>" . $_SESSION['userRoleError'] . "</span>";
                      unset($_SESSION['userRoleError']);
                  }
              }
          ?>
          </span>
        <!-- Submit -->
        <div class="signUpBtnContainer">
          <?php 
            if (isset($_SESSION['userRoleID']) && $_SESSION['userRoleID'] != 3){
                echo "<button type='submit' name='adminSubmit' class='btn signUpBtn'>Sign Up</button>";
            }
            else{
                echo "<button type='submit' name='userSubmit' class='btn signUpBtn'>Sign Up</button>";
            }
        ?>
        </div>
        <span>
          <?php 
          if (isset($_SESSION['requiredError'])){ 
            echo "<span class='errorMessages'>" . $_SESSION['requiredError'] . "</span>";
            unset($_SESSION['requiredError']);
          }
          ?>
        </span>
        <span>
          <?php 
          if (isset($_SESSION['signUpSuccessMessage'])){ 
            echo "<span class='successMessages'>" . $_SESSION['signUpSuccessMessage'] . "</span>";
            unset($_SESSION['signUpSuccessMessage']);
          }
          ?>
        </span>
      </fieldset>
  </form>
</div>