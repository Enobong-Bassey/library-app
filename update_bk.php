<?php
    include './includes/db.php';

    if(isset($_POST['book_id'])) {

        $bookID = $_POST['book_id'];

        $query = "SELECT * FROM books WHERE bid = '$bookID'";
        $result = $conn->query($query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
?>
