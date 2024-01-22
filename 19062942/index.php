<?php require_once "includes/sessionTimeOut.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container imageSliderContainer">
            <div class="imageSlider">
                <div class="slides">
                    <!-- HIDDEN RADIO BUTTONS -->
                    <input type="radio" name="imageSliderRadioBtn" id="radio1">
                    <input type="radio" name="imageSliderRadioBtn" id="radio2">
                    <input type="radio" name="imageSliderRadioBtn" id="radio3">

                    <!-- PHOTOS -->
                    <div class="first"><img src="assets/lilack.png" alt="Lilack" class="imageSliderPhoto"></div>
                    <div><img src="assets/products/occasion/wedding/Lilac Rose Flower Bouquet.jpg" alt="Lilac Rose Flower Bouquet.jpg" class="imageSliderPhoto"></div>
                    <div><img src="assets/products/occasion/graduation/Maltese Petite Flower Bouquet.jpg" alt="Maltese Petite Flower Bouque" class="imageSliderPhoto"></div>
                </div>

                <!-- CUSTOMISED BUTTONS -->
                <div class="buttons">
                    <label for="radio1" class="button"></label>
                    <label for="radio2" class="button"></label>
                    <label for="radio3" class="button"></label>
                </div>
            </div>
        </section>
    </main>
    
    <?php require_once "layouts/footer.php"; ?>
</body>
</html>
