<?php
    session_start();
    date_default_timezone_set('America/Toronto');

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST["secret"] == "createProfile") {

            $street = trim(strtolower($_POST["street"]));
            $city = trim(strtolower($_POST["city"]));
            $province = trim(strtolower($_POST["province"]));
            $zip = trim(strtolower($_POST["zip"]));
            $country = trim(strtolower($_POST["country"]));
            $phone = trim(strtolower($_POST["phone"]));
            
            // echo ucfirst($firstname) . " " . ucfirst($lastname) . "<br>" . $email . "<br>" . $password;

            // connect to DB
            include './includes/db.php';

            // echo "Connected successfully";

            // decide whether this user has already created an account

            // step 1: get the email provided
            // step 2: check if the email is present in the database already
            // step 3: if email exist in database, echo user already exist or if email does not
            //         exist in database move on to the next line of codes.

            $insertQuery = "INSERT INTO memberProfile (mpid, street, city, province, zip, country, phone, email)
            VALUES(null, '$street', '$city', '$province', '$zip', '$country', '$phone', '{$_SESSION["email"]}')";                                                                                                                                                                                               

            if ($conn->query($insertQuery) === TRUE){

            } else {
                echo "Error: " . $insertQuery . " " . $conn->error;
            }

            $_SESSION['street'] = $street;
            $_SESSION['city'] = $city;
            $_SESSION['province'] = $province;
            $_SESSION['zip'] = $zip;
            $_SESSION['country'] = $country;
            $_SESSION['phone'] = $phone;
            
            
            header('Location: ./dashboard.php');


            // $emailCheckQuery = "SELECT email FROM users WHERE email =" . $email;

            // if($emailCheckQuery != ""){
            //     $_SESSION["UserExist"] = "User already exist.";
            //     echo $_SESSION["UserExist"];
            // }

            // insert into the user's table
            
            
        } else if($_POST["secret"] == "updateProfile") {

            $street = trim(strtolower($_POST["street"]));
            $city = trim(strtolower($_POST["city"]));
            $province = trim(strtolower($_POST["province"]));
            $zip = trim(strtolower($_POST["zip"]));
            $country = trim(strtolower($_POST["country"]));
            $phone = trim(strtolower($_POST["phone"]));
     
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