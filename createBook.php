<?php
    include './includes/db.php';

    if(isset($_POST['createBook'])){
        $title = $_POST['bookTitle'];
        $author = $_POST['author'];
        $publishDate = $_POST['datePublished'];
        $edition = $_POST['edition'];
        $publisher = $_POST['publishedBy'];
        $bookClass = $_POST['bookClass'];
        $lateRetFee = $_POST['lateFee'];

        $query = "INSERT INTO books VALUES (null, null, '$title', '$author', '$publisher', '$edition', '$publishDate', '$bookClass', '$lateRetFee')";
        $result = $conn->query($query);

        if($result) {
            header('Location: newBook.php');
        } else {

        }
    }
?>