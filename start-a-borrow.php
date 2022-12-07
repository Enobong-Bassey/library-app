<?php 

    session_start();

    if(!$_SESSION["email"]) {
        $_SESSION["accessError"] = "Please sign up or sign in first!";
        header("Location: ./signup.php");
    }

    require './includes/upHead.php'; 
    
?>

<title>Readers Library - Start a borrow</title>
<meta name="description" content="">

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
          <a class="nav-link active" href="start-a-borrow.php">Start a Borrow</a>
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

<div class="container" id="libraryInfo">

</div>
<div class="container" id="searchCriteria">
    <div class="row">
        <h4 id="bookSearchHeader">Book borrowing reservation</h4><hr>
        <div class="col-md-4 col-sm-8 left" id="searchCriteriaLeft">
            <select name="bookClass" id="bookClass" class="form-control control-sm mb-2">
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
                        echo '<option value="">No book classes available.</option>';
                    }
                ?>
            </select>
            <button type="button" class="btn btn-info btn-sm btn-block" id="retrieveBks" onclick="retBooksInClass()">Get books</button>
        </div>
        <div class="col-md-4 col-sm-8 middle" id="searchCriteriaMiddle">
            <?php 
                $email = $_SESSION['email'];
            ?>
            <input type="hidden" id="userEmail" value="<?php echo $email; ?>">
        </div>
        <div class="col-md-4 col-sm-8 right" id="searchCriteriaRight">

        </div>
    </div>
</div>
<div class="container my-3" id="ownReservedBk"></div>
<div class="container mb-3" id="booksInClass"></div>



<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        displayOwnReservedBooks();
        $('#booksInClass').hide();
    });

    // display member's reserved books
    function displayOwnReservedBooks(){
        var displayOwnReservedBooks = "true";
        var reservedBkData = $('#userEmail').val();
        $.ajax({
            url:'displayReservedBooks.php',
            type:'POST',
            data:{
                displaySend:displayOwnReservedBooks,
                reservedBkSend:reservedBkData
            },
            success:function(data,status){
                $('#ownReservedBk').html(data);
            }
        });
    }

    // delete reserved book (making a change to reserved book list)
    function delReservation(reservedID){
        $.ajax({
            url:"deleteReservedBk.php",
            type:'post',
            data:{
                deletesend:reservedID
            },
            success:function(data,status){
                displayOwnReservedBooks();
            }
        });
    }

    // retrieve books based on class selected
    function retBooksInClass(){
        var reservedBkData = $('#bookClass').val();
        $.ajax({
            url:'retrieveBooksInClass.php',
            type:'POST',
            data:{
                reservedBkSend:reservedBkData
            },
            success:function(data,status){
                $('#booksInClass').html(data);
                $('#booksInClass').show();
            }
        });
    }


    function reserveBookNow(reservedID){
        $.ajax({
            url:"reserveBook.php",
            type:'post',
            data:{
                reserveid:reservedID
            },
            success:function(data,status){
                displayOwnReservedBooks();
            }
        });
    }
        
</script>
</main>
</body>
</html>