<?php
    include './includes/db.php';

    if(isset($_POST['deletesend'])){
        $unique = $_POST['deletesend'];

        $delStaffQuery = "Delete FROM users WHERE uid = '$unique'";
        $result = $conn->query($delStaffQuery);
    }

?>