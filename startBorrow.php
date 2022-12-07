<?php 
  require './includes/upHead.php'; 
?>

<title>Readers Library - Start a borrow</title>
<meta name="description" content="">

<?php 
    require './includes/downHead.php';
?>
    
<?php
    require './includes/header.php';
?>
<li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="startBorrow.php">Start a Borrow</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage Staff</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newStaff.php">New Staff</a></li>
            <li><a class="dropdown-item" href="assignStaff.php">Assign Staff</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Member Activity</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="memberValidate.php">Validate Member</a></li>
            <li><a class="dropdown-item" href="borrowBook.php">Borrow a Book</a></li>
            <li><a class="dropdown-item" href="returnBook.php">Return a Book</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage Books</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newBook.php">New Book</a></li>
            <li><a class="dropdown-item" href="editBook.php">Edit a Book</a></li>
            <li><a class="dropdown-item" href="deleteBook.php">Delete a Book</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>
<main>
    <div class="container">
        <div class="row col-md-4 col-sm-8" id="searchBook">
            <h4 id="bookSearchHeader">Find a book</h4><hr>
            <form action="" method="POST">
          <div class="mb-2">
                <select name="bookClass" id="bookClass" class="form-control">
                  <option value="">Select book class</option>
                  <?php
                        include './includes/db.php';

                        $classQuery = "SELECT * FROM bookClass ORDER BY className";
                        $result = mysqli_query($conn, $classQuery);

                        if(mysqli_num_rows($result) > 0) {

                            while($rows = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $rows["className"] . '">' . $rows["className"] . '</option>';
                            }
                        } else {
                          echo '<option value="">No book classes available</option>';
                        }
                  ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm btn-block" name="retBooks">Get books</button>
          </form>            
        </div>
    </div><br><br>

    <div id="reservedBkTbl">
      <div class="container">
        <?php
          include './includes/db.php';

          if(isset($_SESSION['email'])){
            $userEmail = $_SESSION['email'];

            $reservedBksQuery = "SELECT * FROM memberreservedbooks WHERE email = $userEmail";
            $result = $conn->query($reservedBksQuery);

            if(mysqli_num_rows($result) > 0){
              $ttlreservedBooks = mysqli_num_rows($result);
        ?>
        <div id="profileLbl">You have <?php echo $ttlreservedBooks; ?> books reserved.</div>
            <div class="table-responsive-sm">
                <table class="table table-bordered table-sm table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Book Title</th>
                            <th>Author(s)</th>
                            <th>Classification</th>
                            <th>Year</th>
                            <th>Published by</th>
                            <th>Edition</th>
                            <th>Date Reserved</th>
                            <th>Action Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
              $e = 1;
              while($row = mysqli_fetch_assoc($result)){

                $title = $row['title'];
                $bookclass = $row['book_class'];
                $borrower = $row['requesting_email'];
                $author = $row['author'];
                $year = $row['year_published'];
                $edition = $row['book_edition'];
                $publisher = $row['publisher'];
                $reservationdate = $row['date_reserved'];
                $id = $row['mrbid'];
                $attendantemail = $row['attendant_email'];

                echo '<tr><td>'.$e.'</td><td>'.$title.'</td><td>'.$author.'</td><td>'.$bookclass.'</td><td>'.
                $year.'</td><td>'.$publisher.'</td><td>'.$edition.'</td><td>'.$reservationdate.'</td><td>
                <button class="btn btn-danger" onclick="delReservation('.$id.')">Delete</button></td></tr>';

                $e++;
                echo '</tbody></table></div></div>';
              }
            } else { 
              ?>
        <div id="profileLbl">You have no books reserved.</div>
            <div class="table-responsive-sm">
                <table class="table table-bordered table-sm table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Book Title</th>
                            <th>Author(s)</th>
                            <th>Classification</th>
                            <th>Year</th>
                            <th>Published by</th>
                            <th>Edition</th>
                            <th>Date Reserved</th>
                            <th>Action Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                  echo '<tr><td colspan="9" style="align-text: center;">No books reserved by this member.</td></tr></tbody></table>';
            }
          }
        ?>
      </div>
    </div>

    <div id="tableForUpdate">
          <div class="container">
            <?php
              include './includes/db.php';

              if(isset($_POST['retBooks']) && $_POST['bookClass'] != ''){
                $neededBookClass = $_POST['bookClass'];

                $bksQuery = "SELECT * FROM books WHERE book_class = '" . $neededBookClass . "'";
                $bkResult = $conn->query($bksQuery);

                if(mysqli_num_rows($bkResult) > 0){

                  $totlBooks = mysqli_num_rows($bkResult);
                }
              
            ?>
          <div id="profileLbl"><?php echo $totlBooks; ?> books found in library under the selected class.</div>
            <div class="table-responsive-sm">
                <table class="table table-bordered table-sm table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Book Title</th>
                            <th>Author(s)</th>
                            <th>Classification</th>
                            <th>Year</th>
                            <th>Published by</th>
                            <th>Edition</th>
                            <th>Return Fee</th>
                            <th>Action Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $d = 1;

                          while($rows = mysqli_fetch_assoc($bkResult)) {
                            
                            echo '<tr><td>' . $d . '</td><td>' . $rows['title'] . '</td><td>' . $rows['author'] . 
                            '</td><td>' . $rows['book_class'] . '</td><td>' . $rows['date_published']
                            . '</td><td>' . $rows['published_by'] . '</td><td>' . $rows['edition']
                            . '</td><td>' . $rows['late_return_fee'] . '</td><td>
                            <button type="button" class="btn btn-primary btn-sm btn-block reserveBtn"
                            onclick="reserveBook('.$rows['bid'].')">Reserve</button></td></tr>';

                            $d++;

                          }

                        }
                      ?>
                    </tbody>
                </table>
            </div>
          </div>
      </div>
</main>
    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>    
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>    
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

    <script>

      $(document).ready(function(){
        $('#reservedBkTbl').show();
      })

      // delete reserved book (making a change to reserved book list)
      function delReservation(reservedID){
            $.ajax({
                url:"deleteReservedBk.php",
                type:'post',
                data:{
                    deletesend:reservedID
                },
                success:function(data,status){
                    displayData();
                }
            });
      }

      // retrieve details of book to be reserved
      function reserveBook(bookID){

            $.post("reserveBook.php",{reserveid:bookID},function(data,status){
                var reservebkid = JSON.parse(data);

                $title = reservedbkid.title;
                $bookClass = reservedbkid.book_class;
                $email = reservedbkid.email;
                $author = reservedbkid.author;
                $yrPublish = reservedbkid.date_published;
                $edition = reservedbkid.edition;
                $publisher = reservedbkid.published_by;

            });

            $('#updateStaffModal').modal("show");
        }

    </script>
</body>
</html>
