<?php
    include './includes/db.php';

    if(isset($_POST['updateemail'])){
        $user_email = $_POST['updateemail'];

        $selectQuery = "SELECT * FROM memberprofile WHERE email = $user_email";
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

?>