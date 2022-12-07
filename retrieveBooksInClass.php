<?php
    include './includes/db.php';

    if(isset($_POST['reservedBkSend'])){
        $bookCls = $_POST['reservedBkSend'];

        $booksQuery = "SELECT * FROM books WHERE book_class = '$bookCls'";
        $result = $conn->query($booksQuery);

        $num_rows = mysqli_num_rows($result);

        echo ''.$num_rows.' book(s) found in library under the selected class.';
        $table='<table class="table table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book Title</th>
                <th scope="col">Author</th>
                <th scope="col">Classification</th>
                <th scope="col">Year</th>
                <th scope="col">Published by</th>
                <th scope="col">Edition</th>
                <th scope="col">Action Button</th>
            </tr>
        <thead>';
        
        $number = 1;
        while($row = mysqli_fetch_assoc($result)){

            $id = $row['bid'];
            $title = $row['title'];
            $author = $row['author'];
            $bookClass = $row['book_class'];
            $yrPublished = $row['date_published'];
            $publisher = $row['published_by'];
            $edition = $row['edition'];

            $table.='<tr>
            <td scope="row">'.$number.'</td>
            <td>'.$title.'</td>
            <td>'.$author.'</td>
            <td>'.$bookClass.'</td>
            <td>'.$yrPublished.'</td>
            <td>'.$publisher.'</td>
            <td>'.$edition.'</td>
            <td>
                <button class="btn btn-success btn-sm" onclick="reserveBookNow('.$id.')">Reserve</button>
            </td>
            </tr>';
            $number++;
        }

        $table.='</table>';
        echo $table;
    }

?>