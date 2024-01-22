<?php
require_once "includes/dbController.php";
$db_handler = new DBController();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/13d7b5f603.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/nav.css" />
  </head>
  <body>
      
    <header class="headerFooterContainer">
      <div class="headerFlex">
        <div class="headerHotline">
          <!-- HOTLINE SECTION -->
          <div class="headerHotlineIcon">
            <i class="fas fa-headset icon"></i>
          </div>
          <div class="headerHotlineText">
            <h3>Hotline</h3>
            <span class="sameLine">+6016-9802517</span>
          </div>
        </div>
        <!-- LOGO SECTION -->
        <div class="logo headerLogo">
          <a href="index.php">Lilack</a>
        </div>
        <!-- FUNCTIONALITIES SECTION -->
        <div class="headerFunctions">
          <a href="login.php" class="headerFunction headerProfile">
            <?php 
            if(isset($_SESSION['userID'])){ 
              echo "<a href='profile.php'>" . $_SESSION['userFirstName'] ."</a>";
            }
            else{
              echo "<i class='fas fa-user-circle icon'></i>";
            }
            ?>
          </a>
          <a href="shoppingCart.php" class="headerFunction headerShoppingCart">
            <i class="fas fa-shopping-cart icon"></i>
          </a>
        </div>
      </div>

      <!-- NAVIGATION HAMBURGER POP UP -->
      <input type="checkbox" id="nav-toggle" class="nav-toggle" />
      <label for="nav-toggle" class="nav-toggle-label hamburgerMenu">
        <span></span>
      </label>
      
      <!-- NAVIGATION BAR -->
      <nav>
        <div class="container navFlex">
          <a href="index.php">Home</a>

          <div class="dropDownOccasion">
            <input type="checkbox" id="occasionCheckBox" />
            <label for="occasionCheckBox" class="occasionToggle">
              <span>Occasion</span>
              <i class="fas fa-caret-down"></i>
            </label>
            <ul>
              <!-- LOAD THE PRODUCT CATEGORIES FOR OCCASION -->
              <?php
                $query = $db_handler->getConn()->prepare("SELECT * FROM productCategory, productType WHERE productType.productTypeID = productCategory.productTypeID AND productType = 'Occasion' ORDER BY productCategoryID ASC");
                $query->execute();
                $result = $query->get_result();
                $query->close();
                while ($rows = $result->fetch_assoc()){
                  echo "<li> <a href='productCategory.php?productCategoryID=$rows[productCategoryID]'>$rows[productCategory]</a></li>";
                }
              ?>
            </ul>
          </div>

          <div class="dropDownAddOnItems">
            <input type="checkbox" id="addOnItemsCheckBox" />
            <label for="addOnItemsCheckBox" class="addOnItemsToggle">
              <span>Add On Items</span>
              <i class="fas fa-caret-down"></i>
            </label>
            <ul>
              <!-- LOAD THE PRODUCT CATEGORIES FOR ADD ON ITEMS -->
              <?php
                $query = $db_handler->getConn()->prepare("SELECT * FROM productCategory, productType WHERE productType.productTypeID = productCategory.productTypeID AND productType = 'Add On Items' ORDER BY productCategoryID ASC");
                $query->execute();
                $result = $query->get_result();
                $query->close();
                while ($rows = $result->fetch_assoc()){
                  echo "<li> <a href='productCategory.php?productCategoryID=$rows[productCategoryID]'>$rows[productCategory]</a></li>";
                }
              ?>
            </ul>
          </div>
          <a href="contactUs.php">Contact Us</a>
          <a href="faqs.php">FAQs</a>
        </div>
      </nav>
    </header>

  </body>
</html>
