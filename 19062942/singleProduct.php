<?php 
require_once "includes/sessionTimeOut.php";
require_once "includes/productLikeDislikeInc.php";
require_once "includes/dbController.php";
$db_handler = new DBController();
$productID = $_GET['productID'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/breadCrumb.css" />
    <link rel="stylesheet" href="css/singleProductPage.css" />
</head>
<body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container">
            <!-- BREADCRUMB TRAIL -->
            <div class="breadcrumbTrail">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="wedding.php">Wedding</a></li>
                    <?php
                        $query = $db_handler->getConn()->prepare("SELECT * FROM products WHERE productID= ?");
                        $query->bind_param("d", $productID);
                        $query->execute();
                        $result = $query->get_result();
                        $query->close();
                        $product_array= $result->fetch_assoc();
                        echo "<li><a href='#'>$product_array[productName]</a></li>";
                    ?>
                </ul>
            </div>
        </section>

        <!-- PRODUCT INFORMATION -->
        <section class="container">
            <?php require_once "layouts/singleProductDetails.php"; ?>
        </section>

        <!-- COMMENT SECTION -->
        <section class="container">
            <?php require_once "layouts/commentSection.php"; ?>
        </section>
    </main>
    
    <?php require_once "layouts/footer.php" ?>
</body>
</html>