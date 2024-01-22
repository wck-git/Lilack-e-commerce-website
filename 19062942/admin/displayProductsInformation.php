<?php
    require_once "../includes/dbController.php";
    $db_handler = new DBController();
    ?>

    <h2>Products Information</h2>
    <!-- EDIT PRODUCT INFORMATION -->
    <div class="productInformationChanges">
      <div class="editProductDetails">
        <h3>Edit Product Details</h3>
        <span class="reminder">Reminder: Product name must be unique</span>
        <form action="admin/adminControls.php" method="post">
            <div>
              <label> Product ID: </label>
              <input type="text" name="productID" placeholder="productID">
            </div>
            <div>
              <label> Product Image: </label>
              <input type="text" name="productImage" placeholder="productImage">
            </div>
            <div>
              <label> Product Name: </label>
              <input type="text" name="productName" placeholder="productName">
            </div>
            <div>
              <label> Product Price: </label>
              <input type="text" name="productPrice" placeholder="productPrice">
            </div>
            <button type="submit" class="editProductBtn btn" name="updateProduct">Edit</button>
        </form>
      </div>
      
      <!-- ADD PRODUCT -->
      <div class="addProduct">
        <h3>Add Product</h3>
        <span class="reminder">Reminder: Product name must be unique</span>
        <form action="admin/adminControls.php" method="post">
          <div>
            <label> Product Image: </label>
            <input type="text" name="productImage" placeholder="productImage">
          </div>
          <div>
            <label> Product Name: </label>
            <input type="text" name="productName" placeholder="productName">
          </div>
          <div>
            <label> Product Type ID: </label>
            <input type="text" name="productTypeID" placeholder="productTypeID">
          </div>
          <div>
            <label> Product Category ID: </label>
            <input type="text" name="productCategoryID" placeholder="productCategoryID">
          </div>
          <div>
            <label> Product Price: </label>
            <input type="text" name="productPrice" placeholder="productPrice">
          </div>
          <button type="submit" class="editProductBtn btn" name="addProduct">Add</button>
        </form>
      </div>
    </div>

    <?php
      // DISPLAY PRODUCT TYPE
      $query = $db_handler->getConn()->prepare("SELECT * FROM productType ORDER BY productTypeID ASC");
      $query->execute();
      $result = $query->get_result();
      $query->close();
      if (!empty($result)) { ?>
        <div class="productTypeCategoryTable">
          <table class='productTypeTable'>
            <thead>
              <th>Product Type ID </th>
              <th>Product Type Name</th>
            </thead>
              <?php 
              while($product_array = $result->fetch_assoc()){
                echo "<tbody>";
                echo "<td>" . $product_array['productTypeID'] . "</td>";
                echo "<td>" . $product_array['productType'] . "</td>";
                echo "</tbody>";
              }
            echo "</table>";
      } 
      // DISPLAY PRODUCT CATEGORY
      $query = $db_handler->getConn()->prepare("SELECT * FROM productCategory ORDER BY productCategoryID ASC");
      $query->execute();
      $result = $query->get_result();
      $query->close();
      if (!empty($result)) { ?>
        <table class='productCategoryTable'>
          <thead>
            <th>Product Category ID </th>
            <th>Product Category Name</th>
          </thead>
            <?php 
            while($product_array = $result->fetch_assoc()){
              echo "<tbody>";
              echo "<td>" . $product_array['productCategoryID'] . "</td>";
              echo "<td>" . $product_array['productCategory'] . "</td>";
              echo "</tbody>";
            }
        echo "</table>";
      echo "</div>";
    } 

    $query = $db_handler->getConn()->prepare("SELECT * FROM products, productType, productCategory WHERE products.productTypeID = productType.productTypeID AND products.productCategoryID = productCategory.productCategoryID ORDER BY productID ASC");
    $query->execute();
    $result = $query->get_result();
    $query->close();
    if (!empty($result)) {
      echo "<table>";
        echo "<thead>";
          echo "<th>ID</th>";
          echo "<th>Image</th>";
          echo "<th>Product Name</th>";
          echo "<th>Product Type</th>";
          echo "<th>Product Category</th>";
          echo "<th>Price</th>";
          echo "<th>Remove</th>";
        echo "</thead>";
        while($product_array = $result->fetch_assoc()){
          $productImageUrl = $product_array['productImage'];
          $productName = $product_array['productName'];
          echo "<tbody>";
            echo "<tr>";
              echo "<td>" . $product_array['productID'] . "</td>";
              echo "<td><img src='$productImageUrl' class='productImage'></td>";
              echo "<td>" . $product_array['productName'] . "</td>";
              echo "<td>" . $product_array['productType'] . "</td>";
              echo "<td>" . $product_array['productCategory'] . "</td>";
              echo "<td>" . $product_array['productPrice'] . "</td>";
              echo "<td style='text-align:center;'><a href='admin/adminControls.php?removeProduct=" . $product_array['productID'] . "'>
              <i class='fas fa-trash-alt icon'></i></a></td>";
            echo "<tr>";
          echo "</tbody>";
        }
      echo "</table>";
    }
?>