<?php
{
    include './includes/db.php';

    if(isset($_POST['updateBk'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $book_class = $_POST['book_class'];
        $published_by = $_POST['published_by'];
        $date_published = $_POST['date_published'];
        $edition = $_POST['edition'];
        $late_return_fee = $_POST['late_return_fee'];
        $bid = $_POST['bid'];

        echo $title;

        $updateQuery = "
        UPDATE books 
        SET title = $title,
        author = $author,
        book_class = $book_class,
        published_by = $published_by,
        date_published = $date_published,
        edition = $edition,
        late_return_fee = $late_return_fee
        WHERE bid = '".$_POST["bid"]."'";
        $result = $conn->query($updateQuery);

        if($result){
            header('Location: editBook.php');
        } else {
            echo 'Could not update record. Please contact administrator!';
        }       
    }
}
?>