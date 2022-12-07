<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $path = './assets/images/userimg/';
        $file = $path . basename($_FILES["userPhoto"]["name"]);

        if(move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $file)) {
            include './includes/db.php';

            $updateQuery = "UPDATE users SET photo = '{$file}' WHERE email = '{$_SESSION["email"]}'";
            $updateResult = $conn->query($updateQuery);
            if($conn->query($updateQuery) === TRUE){
                header('Location: ./dashboard.php');
            } else {
                echo 'There was a problem updating user on DB!';
            }
        } else {
            echo "There was a problem";
        }
    }
?>