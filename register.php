
<?php
session_start();

/* if(isset($_SESSION['uid'])) {
  header("Location: profile.php");
  } */

include_once 'dbConnect.php';

$error = false;

if (isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
        $error = true;
        $fname_error = "*First Name must contain only alphabets and space.";
    }
    if (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
        $error = true;
        $lname_error = "*Lastname Name must contain only alphabets and space.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "*Please Enter Valid Email ID.";
    }
    if (strlen($password) < 8) {
        $error = true;
        $password_error = "*Password must be minimum of 6 characters.";
    }
    if ($password != $cpassword) {
        $error = true;
        $cpassword_error = "*Password and Confirm Password do not match.";
    }
    if (!$error) {
        if (mysqli_query($conn, "INSERT INTO user(email,firstName,lastName,password) VALUES('" . $email . "', '" . $firstname . "', '" . $lastname . "', '" . md5($password) . "')")) {
            $successmsg = "Registered Successfully. <a href='login.php'>Click here to Sign in</a>.";
        } else {
            $errormsg = "Error occurred while registering. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <link href="css/mystyle.css" rel='stylesheet' type='text/css' />

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <style>
            body{
                background-image:url(img/i3.JPG)
            }
        </style>
    </head>

    <body >

        <div class="main">

            <!-----start-main
            <div class="inset">
                   <div class="social-icons">
                    <div class="span"><a href="#"><img src="img/fb.png" alt=""/><i>Connect with Facebook </i><div class="clear"></div></a></div>	
                    <div class="span1"><a href="#"><img src="img/t-bird.png" alt=""/><i>Connect with Twitter</i><div class="clear"></div></a></div>
                    <div class="clear"></div>
                   </div>
            </div>	
            ---->
            <header id="header-1" >

                <div id="header" class="dispin">
                    <img id="img2" src="img/im2.jpg" > 

                    </header>




                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="registerform">
                        <div class="lable">
                            <input type="text" class="text" name="firstname" placeholder="Enter First Name" required value="<?php if ($error) echo $firstname; ?>"  id="active"/>
                            <input type="text" class="text" name="lastname" placeholder="Enter Last Name" required value="<?php if ($error) echo $lastname; ?>"/>
                        </div>
                        <div class="clear"> 
                            <p style="color: #FF0000; font-weight: bold; font-size: 12px"><?php if (isset($fname_error)) echo $fname_error; ?></p>
                            <p style="color: #FF0000; font-weight: bold; font-size: 12px"><?php if (isset($lname_error)) echo $lname_error; ?></p></div>
                        <div class="lable-2">
                            <input type="text" class="text" name="email" placeholder="Enter Valid Email" required value="<?php if ($error) echo $email; ?>"/>
                            <p style="color: #FF0000; font-weight: bold; font-size: 12px"><?php if (isset($email_error)) echo $email_error; ?></p>
                            <input type="password" class="text" name="password" placeholder="Enter Password" required>
                            <p style="color: #FF0000; font-weight: bold; font-size: 12px"><?php if (isset($password_error)) echo $password_error; ?></p>
                            <input type="password" class="text" name="cpassword" placeholder="Enter Confirm Passwords" required>
                            <p style="color: #FF0000; font-weight: bold; font-size: 12px"><?php if (isset($cpassword_error)) echo $cpassword_error; ?> </p>
                        </div>
                        <div class="clear"> </div>
                        <h3>By creating an account, you agree to our <span><a href="#">Terms & Conditions</a> <span></h3>
                                    <div class="submit">
                                        <input type="submit" name="register" value="Create account" >
                                    </div>

                                    <div class="clear"> 
                                        <span class="text-success" style="color: #FFFFFF;" ><?php
                                            if (isset($successmsg)) {
                                                echo $successmsg;
                                            }
                                            ?></span>
                                        <span class="text-danger" style="color: #FF0000;"><?php
                                            if (isset($errormsg)) {
                                                echo $errormsg;
                                            }
                                            ?></span>
                                    </div>
                                    </form>


                                    </div>

                                    <div> <button onclick="goBack()" id="button2" style="vertical-align:middle" >Home</button></div>

                                    <script>
                                        function goBack() {
                                            window.open('index.html');
                                        }
                                    </script>

                                    </body>
                                    </html>