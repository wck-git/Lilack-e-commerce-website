<?php require_once "includes/sessionTimeOut.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/logout.css" />
</head>
<body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container">
            <?php 
                if (isset($_SESSION['userRoleID']) && $_SESSION['userRoleID'] < 3){
                    echo "<h2 class='categoryTitle'>Dashboard</h2>";
                    require_once "admin/adminDashBoard.php";
                }
                else{
                    require_once "layouts/logout.php";
                }
            ?>
            
        </section>
    </main>

    <?php require_once "layouts/footer.php" ?>
</body>
</html>