<?php
    session_start();

    $_SESSION['email'] = "";
    $_SESSION['firstname'] = "";
    $_SESSION['lastname'] = "";
    $_SESSION['accessError'] = "";
    $_SESSION['date'] = "";
    $_SESSION['logout'] = "You have logged out successfully.";
    
    header("Location: ./signup.php");
?>