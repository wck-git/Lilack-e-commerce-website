<?php require_once "includes/sessionTimeOut.php" ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lilack</title>
    <link rel="stylesheet" href="css/signUp.css" />
  </head>
  <body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container">
            <div class="breadCrumbTrail">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Sign up</a></li>
                </ul>
            </div>

            <?php require_once "layouts/signUp.php"; ?>
        </section>
    </main>

    <?php require_once "layouts/footer.php" ?>
  </body>
</html>
