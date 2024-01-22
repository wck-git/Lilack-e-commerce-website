<?php session_start(); ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lilack</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <?php require_once "layouts/header.php" ?>

    <main>
      <section>
          <div class="container">
            <!-- BREADCRUMB TRAIL -->
              <div class="breadCrumbTrail">
                  <ul>
                      <li><a href="">Home</a></li>
                      <li><a href="">Login</a></li>
                  </ul>
              </div>
              <!-- LOGIN FORM -->
              <div class="loginForm">
                  <h2 class="categoryTitle">Login</h2>
                  <form action="includes/loginInc.php" method="POST">
                      <fieldset>
                          <label for="">Email</label>
                          <input type="text" name="email" placeholder="Email...">
                          <label for="">Password</label>
                          <input type="password" name="pwd" placeholder="Password...">
                          <div class="loginBtnContainer">
                            <button type="submit" name="submit" class="btn loginBtn">Log In</button>
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
                            if (isset($_SESSION['loginError'])){
                              echo "<span class='errorMessages'>" . $_SESSION['loginError'] . "</span>";
                              unset($_SESSION['loginError']);
                            }
                            ?>
                          </span>
                      </fieldset>
                  </form>
                  <div class="dontHaveAccountSection">
                      <span>Don't have an account?</span>
                      <a href="signUp.php">
                          <button type="submit" class="btn">Sign Up</button>
                      </a>
                  </div>
               </div>
          </div>
      </section>
    </main>

    <?php require_once "layouts/footer.php" ?>
  </body>
</html>
