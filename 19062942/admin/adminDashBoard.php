<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="js/asyncRequest.js"></script>
    <link rel="stylesheet" href="css/signUp.css" />
    <link rel="stylesheet" href="css/adminDashBoard.css" />
  </head>
  <body>
    <main class="dashBoardContents">
        <aside>
            <button onclick='displayInformation(1)'><span>Create Account</span></button>
            <?php if ($_SESSION['userRoleID'] == 1) echo "<button onclick='displayInformation(2)'><span>User</span></button>";?>
            <button onclick='displayInformation(3)'><span>Product</span></button>
            <button onclick='displayInformation(4)'><span>Logout</span></button>
        </aside>

        <section>
            <div id="dashBoardContent">
                <?php require_once "layouts/signUp.php";?>
            </div>
        </section>
    </main>

    <script>
        function displayInformation(value){
            const xhttp = new asyncRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dashBoardContent").innerHTML = this.responseText; // change the admin dashboard content
                }
            };

            if (value === 1){
                xhttp.open("GET", "layouts/signUp.php");
            }
            else if (value === 2){
                xhttp.open("GET", "admin/displayUserInformation.php");
            }
            else if (value === 3){
                xhttp.open("GET", "admin/displayProductsInformation.php");
            }
            else if (value === 4){
                xhttp.open("GET", "layouts/logout.php");
            }
            xhttp.send();
        }
    </script>

  </body>
</html>
