<?php
    session_start();

    include './includes/db.php';

    if(isset($_POST['displaySend']) && isset($_POST['reservedBkSend'])){
        $uEmail = $_POST['reservedBkSend'];

        $reservedBookQuery = "SELECT * FROM memberreservedbooks WHERE requesting_email = '$uEmail'";
        $result = $conn->query($reservedBookQuery);

        $num_rows = mysqli_num_rows($result);

        echo 'You have '.$num_rows.' book(s) reserved.';
        $table = '<table class="table table-sm">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book Title</th>
                <th scope="col">Author</th>
                <th scope="col">Classification</th>
                <th scope="col">Year</th>
                <th scope="col">Published by</th>
                <th scope="col">Edition</th>
                <th scope="col">Date Resrved</th>
                <th scope="col">Action Button</th>
            </tr>
        </thead><tbody>';

        if(mysqli_num_rows($result) > 0){
            $number = 1;
            while($row = mysqli_fetch_assoc($result)){

                $id = $row['mrbid'];
                $title = $row['title'];
                $author = $row['author'];
                $bookClass = $row['book_class'];
                $yrPublished = $row['year_published'];
                $publisher = $row['publisher'];
                $edition = $row['book_edition'];
                $dateReserved = $row['date_reserved'];

                $table.='<tr>
                <td scope="row">'.$number.'</td>
                <td>'.$title.'</td>
                <td>'.$author.'</td>
                <td>'.$bookClass.'</td>
                <td>'.$yrPublished.'</td>
                <td>'.$publisher.'</td>
                <td>'.$edition.'</td>
                <td>'.$dateReserved.'</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" onclick="approveBorrow('.$id.')">Approve</button>
                </td>
                </tr>';
                $number++;
            }

        } else {
            $table.='<tr><td colspan="9" class="text-center">No reserved books to display</td></tr>';
        }

        $table.='</tbody></table>';
        echo $table;
        
    }

?>