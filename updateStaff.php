<?php
    include './includes/db.php';

    if(isset($_POST['updateid'])){
        $user_id = $_POST['updateid'];

        $selectQuery = "SELECT * FROM users WHERE uid = $user_id";
        $result = $conn->query($selectQuery);

        $response = array();
        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status']=200;
        $response['message']="Invalid data or data not found";
    }

    // update query
    if(isset($_POST['hiddenData'])){
        $uniqueID = $_POST['hiddenData'];

        $fname = $_POST['updateFName'];
        $lname = $_POST['updateLName'];
        $email = $_POST['updateEmail'];
        $password = $_POST['updatePassword'];
        $role = $_POST['updateRole'];

        $updateQuery = "UPDATE users SET first_name = '$fname', last_name = '$lname', email = '$email',
        password = '$password', role = '$role' WHERE uid = $uniqueID";
        $result = $conn->query($updateQuery);
        
    }
?>