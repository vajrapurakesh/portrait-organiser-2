<?php
session_start();

if(isset($_SESSION['uid'])) {
    session_destroy();
    unset($_SESSION['uid']);
    unset($_SESSION['uname']);
    header("Location: index.html");
} else {
    header("Location: index.html");
}
?>

