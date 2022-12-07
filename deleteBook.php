<?php
    session_start();
    include './includes/db.php';
    
    // $select = "SELECT * FROM users WHERE email = '{$_SESSION["email"]}' AND role = 'archivist'";
    // $result = $conn->query($select);
    // if(!$result->num_rows > 0) {
    //     header('Location: ./index.php');
    //     exit();
    // }

    $select = "SELECT * FROM users WHERE email = '{$_SESSION["email"]}'";
    $result = $conn->query($select);
    if($result->num_rows > 0) {
        if($row = mysqli_fetch_assoc($result)){
            if($row["role"] == 'member') {
                header('Location: ./index.php');
                exit;
            } else if($row["role"] == 'hr'){
                header('Location: ./index.php');
                exit;
            }  else if($row["role"] == 'attendant'){
              header('Location: ./index.php');
              exit;
            } else {

            }
        }
    } else {
        $_SESSION["accessError"] = "Please sign up or sign in first!";
        header("Location: ./signup.php");
        exit;
    }

    include './includes/upHead.php';
?>

<title>Readers Library - Delete a book</title>
<meta name="description" content="Readers Library's website page for removing a book from the library database.">

<?php 
    require './includes/downHead.php'; 
    require './includes/header.php';
?>

<li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="start-a-borrow.php">Start a Borrow</a>
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
            
            <li><a class="dropdown-item" href="borrowBook.php">Borrow a Book</a></li>
            <li><a class="dropdown-item" href="returnBook.php">Return a Book</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Manage Books</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newBook.php">Enter New Book</a></li>
            <li><a class="dropdown-item" href="editBook.php">Update a Book</a></li>
            <li><a class="dropdown-item active" href="deleteBook.php">Delete a Book</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <a href="./logout.php" class="btn btn-danger" style="text-align: center;">Logout</a>
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>
<main>
  <br><br><br><br><br>
  <div class="container">
    <div class="row" id="bookActionBtns">
      <div class="col-md-4">
        <h2>Book Administration</h2>
      </div>
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <a href="">
          <button type="button" class="btn btn-primary btn-sm" id="createButton" name="createButton">
            Create a Book
          </button>
        </a>
        <a href="./editBook.php">
          <button type="button" class="btn btn-warning btn-sm" id="editButton" name="editButton">
            Update a Book
          </button>
        </a>
        <a href="./deleteBook.php">
          <button type="button" class="btn btn-danger btn-sm" id="deleteButton" name="deleteButton">
            Delete a Book
          </button>
        </a>
      </div><hr id="bookAdmin">
    </div>
  
    <div class="row" id="preSearchBookToDelete">
        <div class="col-md-4 col-sm-8 text-center" id="deleteID">Delete a Book</div>
        <div class="col-md-4 col-sm-8" id="deleteMid"></div>
        <div class="col-md-4 col-sm-8" id="deleteSearch">
          <form action="" method="POST">
          <div class="mb-2">
                <select name="bookClass2" id="bookClass2" class="form-control">
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
                          echo '<option value="">Book class not available</option>';
                        }
                  ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm btn-block" name="retDeleteBook">Get books</button>
          </form>
        </div>
      </div>

      <div id="tableByDelete">
        <div class="container">
        <?php
          include './includes/db.php';

          if(isset($_POST['retDeleteBook']) && $_POST['bookClass2'] != ''){
            $neededBookClass = $_POST['bookClass2'];

            $bksQuery = "SELECT * FROM books WHERE book_class = '" . $neededBookClass . "'";
            $bkResult = $conn->query($bksQuery);

            if(mysqli_num_rows($bkResult) > 0){

              $totlBooks = mysqli_num_rows($bkResult);
            }
          
        ?>
        <div id="profileLbl"><?php echo $totlBooks ?> books found in library under the selected class.</div>
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
                            <button type="button" class="btn btn-danger btn-sm btn-block delBtn">Delete</button></td></tr>';

                            $d++;
                          }

                        } else {
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="container">
      <?php
          include './includes/db.php';

          $booksQuery = "SELECT * FROM books";
          $bookResult = $conn->query($booksQuery);

          if(mysqli_num_rows($bookResult) > 0) {

            $totalBooks = mysqli_num_rows($bookResult);
      ?>
      <div id="profileLbl"><?php echo $totalBooks ?> books found in library under the selected class.</div>
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
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                            $i = 1;

                            while($row = mysqli_fetch_assoc($bookResult)) {
                              
                              echo '<tr><td>' . $i . '</td><td>' . $row['title'] . '</td><td>' . $row['author'] . 
                              '</td><td>' . $row['book_class'] . '</td><td>' . $row['date_published']
                              . '</td><td>' . $row['published_by'] . '</td><td>' . $row['edition']
                              . '</td><td>' . $row['late_return_fee'] . '</td></tr>';

                              $i++;
                            }
                          }
                        }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</main>

<!-- Update Book Modal -->
<div class="modal fade" id="editbookmodal" tabindex="-1" aria-labelledby="editbookmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editbookmodalLabel">Enter a Book</h1>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"> X </button>
      </div>
      <form action="createBook.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="row">
            <div class="col-md-5 text-center mb-2">
              <?php
              include './includes/db.php';
              $selectPhoto = "SELECT book_photo FROM books WHERE title = '{$_SESSION["bookTitle"]}'";
              $resultimg = $conn->query($selectPhoto);
                  if($resultimg->num_rows > 0) {
                      $rowimg = mysqli_fetch_assoc($resultimg);
                      if($rowimg["book_photo"] != null) {
                          echo "<img src='" . $rowimg["book_photo"] . "' width='100px'>";
                      } else {
                          echo "<img src='./assets/img/bookCover.png' width='100px'>";
                      }
                  } 
              ?>
              <form action="./upload.php" method="POST" enctype="multipart/form-data">
                  <p><strong>change your photo</strong><p>
                  <p><input type="file" name="userPhoto" ></p>
                  <p><input type="submit" value="upload" class="btn btn-primary" ></p>
              </form>
            </div>
            <div class="mb-2">
                <label for="bookTitle" class="form-label" id="profileLbl">Book Title</label>
                <input type="text" class="form-control" id="bookTitle" name="bookTitle">
            </div>
            <div class="mb-2">
                <label for="bookClass" class="form-label" id="profileLbl">Book Class</label>
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
                          echo '<option value="">Book class not available</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-8">
              <div class="mb-2">
                  <label for="author" class="form-label" id="profileLbl">Author(s)</label>
                  <textarea type="text" class="form-control" id="author" name="author" rows="3" columns="100"></textarea>
              </div>
            </div>
            
              <div class="mb-2">
                  <label for="datePublished" class="form-label" id="profileLbl">Year Published</label>
                  <input type="type" class="form-control" id="datePublished" name="datePublished">
              </div>
              <div class="mb-2">
                <label for="edition" class="form-label" id="profileLbl">Edition</label>
                <input type="type" class="form-control" id="edition" name="edition">
              </div>              
            
            <div class="mb-2">
                <label for="publishedBy" class="form-label" id="profileLbl">Publisher</label>
                <input type="type" class="form-control" id="publishedBy" name="publishedBy">
            </div>
            <div class="mb-2">
                <label for="lateFee" class="form-label" id="profileLbl">Late Return Fee</label>
                <input type="type" class="form-control" id="lateFee" name="lateFee">
            </div>
          </div>
      </div>
      <div class="modal-footer text-center">
      <button type="reset" name="resetForm" class="btn btn-secondary btn-sm">Clear</button>
        <button type="submit" name="createBook" class="btn btn-primary btn-sm">Send</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="row" id="balancer"></div>


<!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script>

$(document).ready(function(){
  $('.editBtn').on('click', function() {

    $('#editbookmodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#edition').val(data[3]);
      $('#bookID').val(data[0]);
      $('#bookTitle').val(data[1]);
      $('#bookClass').val(data[4]);
      $('#author').val(data[2]);
      $('#datePublished').val(data[5]);
      $('#publishedBy').val(data[6]);
      $('#lateFee').val(data[7]);
  });
});

</script>
<?php
  include './includes/footer.php';
?>
</body>
</html>
