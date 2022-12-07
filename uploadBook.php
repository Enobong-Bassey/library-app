<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $path = "./assets/img/userimg/";
        $file = $path . $_SESSION["email"] . basename($_FILES["userPhoto"]["name"]); 
        // ./assets/img/userimg/user.png

        if(move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $file)) {
            // echo "Success! " . basename($_FILES["userPhoto"]["name"]) . " has been uploaded!";
            // add photo path to DB
            include './includes/db.php';
            $updateUser = "UPDATE users SET photo = '$file' WHERE email = '{$_SESSION["email"]}'";
            if($conn->query($updateUser) === TRUE){
                // redirect to profile page
                header("Location: ./profile.php");
            } else {
                echo 'There was a problem uploading the photo to DB!';
            }            
        } else {
            echo "There was a problem with the upload";
        }
    }
?>