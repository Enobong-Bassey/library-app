<?php
    session_start();
    date_default_timezone_set('America/Toronto');

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST["secret"] == "signup") {

            $firstname = trim(strtolower($_POST["fname"]));
            $lastname = trim(strtolower($_POST["lname"]));
            $email = trim(strtolower($_POST["email"]));
            $password = md5($_POST["pass"]);
            // echo ucfirst($firstname) . " " . ucfirst($lastname) . "<br>" . $email . "<br>" . $password;

            // connect to DB
            include './includes/db.php';

            // echo "Connected successfully";

            // decide whether this user has already created an account

            // step 1: get the email provided
            // step 2: check if the email is present in the database already
            // step 3: if email exist in database, echo user already exist or if email does not
            //         exist in database move on to the next line of codes.

            $select = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '" . $email . "'");
            if(mysqli_num_rows($select)){
                $_SESSION['message'] = "User already exists. Please sign in";
                header("Location: ./signup.php");
                exit();
            }
                
            $insertQuery = "INSERT INTO users (uid, first_name, last_name, email, password, joined_date)
            VALUES(null, '$firstname', '$lastname', '$email', '$password', current_timestamp())";

            if ($conn->query($insertQuery) === TRUE){

            } else {
                echo "Error: " . $insertQuery . " " . $conn->error;
            }

            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;
            $_SESSION['date'] = date('Y/m/d H:i:s');
            
            header('Location: ./dashboard.php');


            // $emailCheckQuery = "SELECT email FROM users WHERE email =" . $email;

            // if($emailCheckQuery != ""){
            //     $_SESSION["UserExist"] = "User already exist.";
            //     echo $_SESSION["UserExist"];
            // }

            // insert into the user's table
            
            
        } else if($_POST["secret"] == "signin") {

            $email = trim(strtolower($_POST["email"]));
            $password = md5($_POST["pass"]);
            echo $email . "<br>" . $password;

            // connect to DB
            include './includes/db.php';

            // Check connection
            if($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            $selectUser = "SELECT * FROM `users` WHERE `email` = '" . $email . "' and `password` = '" . $password . "'";
            $result = $conn->query($selectUser);

            if ($result->num_rows > 0) {
                // output data of each row
                $row = mysqli_fetch_assoc($result);
                    
                        $_SESSION["firstname"] = $row["first_name"];
                        $_SESSION["lastname"] = $row["last_name"];
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["date"] = $row["date"];
                        $_SESSION["usertype"] = $row["user_type"];
                        $_SESSION["verifystatus"] = $row["verify_status"];

                        mysqli_close($conn);

                        header('Location: ./dashboard.php');
                        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                             
            } else {
                mysqli_close($conn);
                $_SESSION["invalidUser"] = "Email or password is wrong. Check and try again.";
                header('Location: ./signup.php');
                exit;
            }
            // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/classproject/profile.php');
            // exit;
        }        
    }
?>