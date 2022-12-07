<?php
    session_start();

    include './includes/db.php';

    if(isset($_POST['reserveid'])){
        $reservebkid = $_POST['reserveid'];

        $selectQuery = "SELECT * FROM books WHERE bid = '$reservebkid'";
        $result = $conn->query($selectQuery);

        $response = array();
        while($row = mysqli_fetch_assoc($result)){
            
            $title = $row['title'];
            $bookClass = $row['book_class'];
            $email = $_SESSION['email'];
            $author = $row['author'];
            $yrPublish = $row['date_published'];
            $edition = $row['edition'];
            $publisher = $row['published_by'];

            $insertQuery = "INSERT INTO memberreservedbooks (mrbid, title, book_class, requesting_email, author, year_published,
            book_edition, publisher, date_reserved) VALUES (null, '$title', '$bookClass', '$email', '$author', '$yrPublish',
            '$edition', '$publisher', current_timestamp())";
            $result = $conn->query($insertQuery);

            if($result){
                header('Location: start-a-borrow.php');
            }
        }

        echo json_encode($response);
    }else{
        $response['status']=200;
        $response['message']="Invalid data or data not found";
    }

?>