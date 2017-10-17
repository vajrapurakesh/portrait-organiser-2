<?php
session_start();



include_once 'dbConnect.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if ($email == "Email" || $password == "Password") {
        $errormsg = "Enter both email and password";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '" . $email . "' and password = '" . md5($password) . "'");

        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['uid'] = $row['UId'];
            $_SESSION['fname'] = $row['firstName'];
            $_SESSION['lname'] = $row['lastName'];
            header("Location: profile.php");
        } else {
            $errormsg = "Password or email entered is incorrect";
        }
    }
}
?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/supersized.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>


        <div class="page-container">

            <h1>Login</h1>
            <form action="" method="post">
                <input type="text" name="email" class="username" placeholder="Email" required>
                <input type="password" name="password" class="password" placeholder="Password" required><br><br>
                <span><?php
                    if (isset($errormsg)) {
                        echo $errormsg;
                    }
                    ?></span><br>
                <button type="submit" name="login">Sign Up</button>

            </form>
            <button onclick="goBack()" id="button2">Home</button>
        </div>



        <script>
            function goBack() {
                window.open('index.html');
            }
        </script>

        <!-- Javascript -->
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/supersized.3.2.7.min.js"></script>
        <script src="js/supersized-init.js"></script>
        <script src="js/scripts.js"></script>

    </body>

</html>
