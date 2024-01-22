<?php require_once "includes/sessionTimeOut.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilack</title>
    <link rel="stylesheet" href="css/checkout.css" />
</head>
<body>
    <?php require_once "layouts/header.php" ?>

    <main>
        <section class="container checkoutContainer">
            <form action="includes/checkoutInc.php" method="post">
                <div class="deliveryForm">
                    <h2>Delivery Form</h2>
                    
                    <fieldset>
                        <label>Sender Contact Number:</label>
                        <input type="text" name="contactNumber" placeholder="0123456789">
                        <span>
                            <?php
                                if (isset($_SESSION['deliveryContactNumberError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['deliveryContactNumberError'] . "</span>";
                                    unset($_SESSION['deliveryContactNumberError']);
                                }
                            ?>
                        </span>
                        <label>Address:</label>
                        <input type="text" name="address" placeholder="10, Jalan SS 1/1">
                        <span>
                            <?php
                                if (isset($_SESSION['deliveryAddressError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['deliveryAddressError'] . "</span>";
                                    unset($_SESSION['deliveryAddressError']);
                                }
                            ?>
                        </span>
                        <label>Postcode:</label>
                        <input type="text" name="postcode" placeholder="47300">
                        <span>
                            <?php
                                if (isset($_SESSION['deliveryPostcodeError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['deliveryPostcodeError'] . "</span>";
                                    unset($_SESSION['deliveryPostcodeError']);
                                }
                            ?>
                        </span>
                        <label>City:</label>
                        <input type="text" name="city" placeholder="Petaling Jaya">
                        <span>
                            <?php
                                if (isset($_SESSION['deliveryCityError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['deliveryCityError'] . "</span>";
                                    unset($_SESSION['deliveryCityError']);
                                }
                            ?>
                        </span>
                        <label>State:</label>
                        <input type="text" name="state" placeholder="Selangor">
                        <span>
                            <?php
                                if (isset($_SESSION['deliveryStateError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['deliveryStateError'] . "</span>";
                                    unset($_SESSION['deliveryStateError']);
                                }
                            ?>
                        </span>
                        <span>
                            <?php 
                                if (isset($_SESSION['deliveryRequiredMessage'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['deliveryRequiredMessage'] . "</span>";
                                    unset($_SESSION['deliveryRequiredMessage']);
                                }
                            ?>
                        </span>
                    </fieldset>
                </div>

                <div class="paymentForm">
                    <h2>Payment</h2>
                    <fieldset>
                        <label for="">Card Number:</label>
                        <div class="cardIcons">
                            <i class="fab fa-cc-visa icon"></i>
                            <i class="fab fa-cc-mastercard icon"></i>
                            <i class="fab fa-cc-amex icon"></i>
                        </div>
                        <input type="text" name="cardNumber" placeholder="0000000000000">
                        <span>
                            <?php
                                if (isset($_SESSION['cardNumberError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['cardNumberError'] . "</span>";
                                    unset($_SESSION['cardNumberError']);
                                }
                            ?>
                        </span>
                        <label for="">Card Security Code (CSC):</label>
                        <input type="text" name="cardSecurityNumber" id="csc" placeholder="000">
                        <span>
                            <?php
                                if (isset($_SESSION['cardSecurityNumberError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['cardSecurityNumberError'] . "</span>";
                                    unset($_SESSION['cardSecurityNumberError']);
                                }
                            ?>
                        </span>
                        <label>Expiration: </label>
                        <input type="text" name="expirationMonth" class="expiration" placeholder="MM">
                        <span>
                            <?php
                                if (isset($_SESSION['expirationMonthError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['expirationMonthError'] . "</span>";
                                    unset($_SESSION['expirationMonthError']);
                                }
                            ?>
                        </span>
                        <span>/</span>
                        <input type="text" name="expirationYear" class="expiration" placeholder="YY">
                        <span>
                            <?php 
                                if (isset($_SESSION['expirationYearError'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['expirationYearError'] . "</span>";
                                    unset($_SESSION['expirationYearError']);
                                  }
                            ?>
                        </span>
                        <span>
                            <?php
                                if (isset($_SESSION['paymentRequiredMessage'])){
                                    echo "<span class='errorMessages'>" . $_SESSION['paymentRequiredMessage'] . "</span>";
                                    unset($_SESSION['paymentRequiredMessage']);
                                }
                            ?>
                        </span>
                    </fieldset>
                </div>

                <div class="actionContainer">
                    <span>Cancel</span>
                    <button type="submit" name="confirmPayment" class="btn actionBtn">Confirm Payment</button>
                </div>
            </form>
        </section>
    </main>

    <?php require_once "layouts/footer.php" ?>
</body>
</html>