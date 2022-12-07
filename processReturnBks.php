<?php
    include './includes/db.php';

    if(isset($_POST['updateSend'])){
        $unique = $_POST['updateSend'];

        $returnBookQuery = "UPDATE borrowedbooks SET date_returned = current_timestamp() WHERE bbid = '$unique'";
        $result = $conn->query($returnBookQuery);
    }

?>