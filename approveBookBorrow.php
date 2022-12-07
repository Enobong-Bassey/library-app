<?php
    session_start();

    include './includes/db.php';

    if(isset($_POST['memberid']) && isset($_POST['reserveid'])){
        $memEmail = $_POST['memberid'];
        $issuerEmail = $_SESSION['email'];
        $rid = $_POST['reserveid'];

        $reservedBookQuery = "SELECT * FROM memberreservedbooks WHERE requesting_email = '$memEmail' AND mrbid = '$rid'";
        $result = $conn->query($reservedBookQuery);

        if(mysqli_num_rows($result) > 0){

            while($data = mysqli_fetch_assoc($result)){
                $id = $data['mrbid'];
                $title = $data['title'];
                $author = $data['author'];
                $memEmail = $data['requesting_email'];
                $bookClass = $data['book_class'];
                $publisher = $data['publisher'];
                $year = $data['year_published'];
                $edition = $data['book_edition'];

                $returndate = "SELECT CURRENT_DATE() + 7";
                
                $bookBorrowQuery = "INSERT INTO borrowedbooks (bbid, title, author, book_class, year, edition, publisher, borrowingemail, issuingemail, date_borrowed, due_return_date)
                 VALUES (null, '$title', '$author', '$bookClass', '$year', '$edition', '$publisher', '$memEmail', '$issuerEmail', current_timestamp(), '$returndate')";
                $result2 = $conn->query($bookBorrowQuery); 
                
                if(mysqli_num_rows($result2) > 0){
                    $deletePreReservationQuery = "DELETE * FROM memberreservedbooks WHERE requesting_email = '$memEmail' AND mrbid = '$id'";
                    $result3 = $conn->query($deletePreReservationQuery);
                }
            }

        }        
        
    }

?>