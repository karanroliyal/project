<?php

session_start();

if(isset($_SESSION['email'])){
    header("location:layout.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <title>Login</title>
</head>

<body>

    <div class="login-wrapper">


        <div class="login-box-container container">

            <div class="col image_box"></div>
            <div class="col form_box">
                <div class="my-logo-container">
                    <img src="assets/images/logo.png" alt="logo">
                </div>
                <h2 class="login-text">Log in</h2>
                <form id="login_form">

                    <div>
                        <input type="text" placeholder="Enter your email" id="emailId" name="user_email">
                        <p id="emailErr">
                        <p>
                    </div>

                    <div>
                        <input type="password" placeholder="Enter your password" id="passwordId" name="user_password">
                        <p id="passwordErr">
                        <p>
                    </div>

                    <button type="submit" id="btn-login">Login</button>

                    <div id="alert-message">
                        <!-- <div class="alert alert-success" role="alert">
                            A simple success alert—check it out!
                        </div> -->
                    </div>

                </form>
            </div>

        </div>








    </div>







    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>