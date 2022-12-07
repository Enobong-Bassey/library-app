<?php
    session_start();

    include './includes/db.php';

    if(isset($_POST['displaySend']) && isset($_POST['reservedBkSend'])){
        $uEmail = $_POST['reservedBkSend'];

        $reservedBookQuery = "SELECT * FROM borrowedbooks WHERE borrowingemail = '$uEmail' AND date_returned is null";
        $result = $conn->query($reservedBookQuery);

        $num_rows = mysqli_num_rows($result);

        echo 'You have '.$num_rows.' book(s) currently in your possession.';
        $table = '<table class="table table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book Title</th>
                <th scope="col">Author</th>
                <th scope="col">Classification</th>
                <th scope="col">Year</th>
                <th scope="col">Published by</th>
                <th scope="col">Edition</th>
                <th scope="col">Date borrowed</th>
                <th scope="col">Action Button</th>
            </tr>
        </thead><tbody>';

        if(mysqli_num_rows($result) > 0){
            $number = 1;
            while($row = mysqli_fetch_assoc($result)){

                $id = $row['bbid'];
                $title = $row['title'];
                $author = $row['author'];
                $bookClass = $row['book_class'];
                $yrPublished = $row['year'];
                $publisher = $row['publisher'];
                $edition = $row['edition'];
                $dateBorrowed = $row['date_borrowed'];

                $table.='<tr>
                <td scope="row">'.$number.'</td>
                <td>'.$title.'</td>
                <td>'.$author.'</td>
                <td>'.$bookClass.'</td>
                <td>'.$yrPublished.'</td>
                <td>'.$publisher.'</td>
                <td>'.$edition.'</td>
                <td>'.$dateBorrowed.'</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="returnBorrowedBks('.$id.')">Return</button>
                </td>
                </tr>';
                $number++;
            }

        } else {
            $table.='<tr><td colspan="9" class="text-center">You currently have no borrowed books to display</td></tr>';
        }

        $table.='</tbody></table>';
        echo $table;
        
    }

?>