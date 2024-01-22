<?php require_once "includes/sessionTimeOut.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/breadCrumb.css" />
    <link rel="stylesheet" href="css/faqs.css" />
</head>
<body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container">
            <!-- BREADRCRUMB TRAIL -->
            <div class="breadCrumbTrail">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
        </section>

        <!-- FAQ -->
        <section class="container">
          <h2 class="categoryTitle">FAQS</h2>

          <div class="questions">

              <!-- OUR PRODUCTS -->
            <h3 class="question-heading">Our Products</h3>
            <ol>
                <li>
                    <h4>What are the products Lilack offering?</h4>
                    <p>Lilack offers floral products such as flower bouquets and additional items such as chocolates and soft toys.</p>
                </li>
                <li>
                    <h4>How long can I store the flowers?</h4>
                    <p>Flower can be kept for within 2 weeks.</p>
                </li>
            </ol>
          </div>

            <div class="questions">
                <!-- DELIVERY -->
                <h3 class="question-heading">Delivery</h3>
                <ol>
                    <li>
                        <h4>Where does Lilack deliver to?</h4>
                        <p>We deliver to PJ and KL area.</p>
                    </li>
                    <li>
                        <h4>Does Lilack charge on delivery?</h4>
                        <p>Yes, we do charge for delivery fees for RM 6.00 for every order regardless of the location in Malaysia.</p>
                    </li>
                    <li>
                        <h4>Can I change the delivery date and time?</h4>
                        <p>Yes, kindly notify us about your new delivery date and time at least 24 hours before the delivery date.</p>
                    </li>
                </ol>
            </div>
        </section>
    </main>
    
    <?php require_once "layouts/footer.php" ?>
</body>
</html>