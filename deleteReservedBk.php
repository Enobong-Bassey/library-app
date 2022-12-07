<?php
    include './includes/db.php';

    if(isset($_POST['deletesend'])){
        $unique = $_POST['deletesend'];

        $delMRBQuery = "DELETE FROM memberreservedbooks WHERE mrbid = '$unique'";
        $result = $conn->query($delMRBQuery);
    }

?>