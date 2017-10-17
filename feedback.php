<?php
session_start();


include_once 'dbConnect.php';

$error = false;

if (isset($_POST['submit'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
    }

    if (!$error) {
        if (mysqli_query($conn, "INSERT INTO feedback(email,firstName,lastName,comments) VALUES('" . $email . "', '" . $firstName . "', '" . $lastName . "', '" . $comments . "')")) {
            echo '<script language="javascript">';
            echo 'alert("Thank you for the feedback.")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error occurred. Try Again.")';
            echo '</script>';
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
<html>
    <head>
        <link rel="stylesheet" href="css/feedback1style.css" />
        <title>feedback</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/supersized.css">
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/supersized.3.2.7.min.js"></script>
        <script src="js/supersized-init.js"></script>
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="search">
                <ul class="nav1">

                    <li id="options">
                        <a href="#" >Menu</a>
                        <ul class="subnav">
                            <li><a href="index.html">Home</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="row header" style="background:url(img/backgrounds/2.jpg)">
                <h1>Do you have any suggestions?</h1>
                <h3>Please send the feedback.</h3>
            </div>
            <div class="row body">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="Commentsform">
                    <ul>

                        <li>
                            <p class="pleft">
                                <label>First Name</label>
                                <input type="text" name="firstName" placeholder=""  />
                            </p>
                            <p class="pright">
                                <label >Last Name</label>
                                <input type="text" name="lastName" placeholder="" />      
                            </p>
                        </li>

                        <li>
                            <p>
                                <label >Email <span class="req">*</span></label>
                                <input type="email" name="email" placeholder="xxxxxx@email.com" required value="<?php if ($error) echo $email; ?>"/>
                            </p>
                            <p style="color: #FF0000; font-weight: bold; font-size: 12px"><?php if (isset($email_error)) echo $email_error; ?></p>
                        </li>        
                        <li><div class="divider"></div></li>
                        <li>
                            <label >Comments</label>
                            <textarea cols="46" rows="3" name="comments" placeholder="Write here...." ></textarea>
                        </li>

                        <li>
                            <input class="btn btn-submit" type="submit" name="submit" value="Submit" />
                        </li>

                    </ul>
                </form>  
            </div>
        </div>
    </body>
</html>
