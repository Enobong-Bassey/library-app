<?php 

session_start();

// if(!$_SESSION["email"]) {
//     $_SESSION["accessError"] = "Please sign up or sign in first!";
//     header("Location: ./signup.php");
// }
$select = "SELECT * FROM users WHERE email = '{$_SESSION["email"]}'";
$result = $conn->query($select);
if($result->num_rows > 0) {
    if($row = mysqli_fetch_assoc($result)){
        if($row["role"] == 'member') {
            header('Location: ./index.php');
            exit;
        } else if($row["role"] == 'achivist'){
            header('Location: ./index.php');
            exit;
        }  else if($row["role"] == 'hr'){
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

    require './includes/upHead.php'; 
    
?>

<title>Document</title>
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
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Member Activity</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item active" href="borrowBook.php">Borrow a Book</a></li>
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
    <a href="./logout.php" class="btn btn-danger" style="text-align: center;">Logout</a>
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>
<main>

<div class="container" id="libraryInfo"></div>
<div class="container" id="memberDetails">
    <div class="row">
        <h4 id="bookSearchHeader">Borrowing a book</h4><hr>
        <div class="col-md-4 col-sm-8" id="left">
            <label id="profileLbl" class="control-label">Member Email</label>
            <input type="text" name="memberEmail" class="form-control mb-2" id="memberEmail" >
            <button class="btn btn-info btn-block" onclick="retMemberTables()">Get Record</button>
        </div>
        <div class="col-md-4 col-sm-8" id="middle"></div>
        <div class="col-md-4 col-sm-8" id="right"></div>
    </div>
</div>
<div class="container" id="reservedBooks"></div>
<div class="container" id="borrowedBooks"></div>


<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

<script>


    function retMemberTables() {
        displayMemberReservedBooks();
        displayMemberBorrowedBooks();
    }

    // display member's reserved books
    function displayMemberReservedBooks(){
        var displayMemberReservedBooks = "true";
        var reservedBkData = $('#memberEmail').val();
        $.ajax({
            url:'displayMemberReservedBooks.php',
            type:'POST',
            data:{
                displaySend:displayMemberReservedBooks,
                reservedBkSend:reservedBkData
            },
            success:function(data,status){
                $('#reservedBooks').html(data);
            }
        });
    }

    // display member's borrowed books
    function displayMemberBorrowedBooks(){
        var displayMemberBorrowedBooks = "true";
        var reservedBkData = $('#memberEmail').val();
        $.ajax({
            url:'displayMemberBorrowedBooks.php',
            type:'POST',
            data:{
                displaySend:displayMemberBorrowedBooks,
                reservedBkSend:reservedBkData
            },
            success:function(data,status){
                $('#borrowedBooks').html(data);
            }
        });
    }

    function approveBorrow(reserveID){
        var memberEmail = $('#memberEmail').val();

        $.ajax({
            url:"approveBookBorrow.php",
            type:'post',
            data:{
                reserveid:reserveID,
                memberid:memberEmail
            },
            success:function(data,status){
                retMemberTables();
            }
        });
    }

</script>
</main>
</body>
</html>