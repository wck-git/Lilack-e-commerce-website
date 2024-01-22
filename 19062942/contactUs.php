<?php require_once "includes/sessionTimeOut.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/breadCrumb.css" />
    <link rel="stylesheet" href="css/contactUs.css" />
</head>
<body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container">
            <div class="breadCrumbTrail">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </section>

        <section class="container">
            <h2 class="categoryTitle">Contact Us</h2>

            <div class="contactUsFlex">
                <!-- CONTACT US PHOTO -->
                <div class="contactUsPhoto">
                    <img src="assets/lilack.png" class="companyLogo" alt="Lilack">
                </div>
                
                <!-- CONTACT US INFORMATION -->
                <div class="contactUsInformation">
                    <p>Hello there, Welcome browsing our website! If you require immediate customer support, or are interested in collaborating with us, or have other questions, here's our contact information.</p>
                    <p>Working hours: 10am - 9pm (everyday)</p>
                    <h4>Address: </h4>
                    <p>5, Jalan Universiti, Bandar Sunway, 47500 Petaling Jaya, Selangor</p>
                    <h4>Hotline: </h4>
                    <p>+6016-9802517</p>
                    <h4>Email: </h4>
                    <p>Lilack@email.com</p>
                </div>
            </div>
        </section>
    </main>
    
    <?php require_once "layouts/footer.php" ?>
</body>
</html>