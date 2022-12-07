<?php 

    session_start();
    include './includes/db.php';

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

    require './includes/upHead.php'; 
    
?>

<title>Readers Library - Manage Staff</title>
<meta name="description" content="">

<style>
  body {
    background-color: beige;
  }
</style>

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
          <a class="nav-link" href="start-a-Borrow.php">Start a Borrow</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="" role="button" data-bs-toggle="dropdown">Manage Staff</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item active" href="newStaff.php">New Staff</a></li>
            <li><a class="dropdown-item" href="assignStaff.php">Assign Staff</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">Member Activity</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="borrowBook.php">Borrow a Book</a></li>
            <li><a class="dropdown-item" href="returnBook.php">Return a Book</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">Manage Books</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newBook.php">Manage Books</a></li>
            <li><a class="dropdown-item" href="editBook.php">Manage Book Classes</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <a href="./logout.php" class="btn btn-danger" style="text-align: center;">Logout</a>
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>

<!-- Create Staff Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staffModalLabel">New Staff</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="insertStaff.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="completeFName">First Name</label>
            <input type="text" class="form-control" name="completeFName" placeholder="Enter staff first name">
        </div>
        <div class="form-group">
            <label for="completeLName">Last Name</label>
            <input type="text" class="form-control" name="completeLName" placeholder="Enter staff last name">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" class="form-control" name="completeRole" placeholder="Enter staff role">
        </div>
        <div class="form-group">
            <label for="completeEmail">Email</label>
            <input type="text" class="form-control" name="completeEmail" placeholder="Enter staff email">
        </div>
        <div class="form-group">
            <label for="completePassword">Password</label>
            <input type="password" class="form-control" name="completePassword" placeholder="Enter staff password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submitStaffBtn">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Staff Modal -->
<div class="modal fade" id="updateStaffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staffModalLabel">Update Staff Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="updateStaffRecord.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="updateFName">First Name</label>
            <input type="text" class="form-control" id="updateFName" name="updateFName" placeholder="Enter staff first name">
        </div>
        <div class="form-group">
            <label for="updateLName">Last Name</label>
            <input type="text" class="form-control" id="updateLName" name="updateLName" placeholder="Enter staff last name">
        </div>
        <div class="form-group">
            <label for="updateRole">Role</label>
            <input type="text" class="form-control" id="updateRole" name="updateRole" placeholder="Enter staff role">
        </div>
        <div class="form-group">
            <label for="updateEmail">Email</label>
            <input type="text" class="form-control" id="updateEmail" name="updateEmail" placeholder="Enter staff email">
        </div>
        <div class="form-group">
            <label for="updatePassword">Password</label>
            <input type="password" class="form-control" id="updatePassword" name="updatePassword" placeholder="Enter staff password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="updateStfBtn" name="updateStfBtn" onclick="updatestaffdetails()">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="hidden" id="hiddenData">
      </div>
      </form>
    </div>
  </div>
</div>

    <main><br><br><br><br><br>
        <div class="container my-3 text-center" id="bodyStaff">
            <h2><span style="text-align: center;"><i class="fa-solid fa-book-open-reader"></i><br>Readers Library</span></h2>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staffModal">
                Add new staff
            </button>
            <div id="displayStaffTable" class="my-3"></div>
        </div>
        
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            displayData();

            $('document').on('click','#submitStaffBtn',function(){
                addStaff();
            })
        });

        function displayData(){
            var displayData = "true";
            $.ajax({
                url:'displayStaff.php',
                type:'POST',
                data:{
                    displaySend:displayData
                },
                success:function(data,status){
                    $('#displayStaffTable').html(data);
                }
            });
        }

        function addStaff(){
            var addFName = $('#completeFName').val();
            var addLName = $('#completeLName').val();
            var addRole = $('#completeRole').val();
            var addEmail = $('#completeEmail').val();
            var addPassword = $('#completePassword').val();

            $.ajax({
                url:"insertStaff.php",
                type:"POST",
                data:{
                   fnameSend:addFName,
                   lnameSend:addLName,
                   roleSend:addRole,
                   emailSend:addEmail,
                   passwordSend:addPassword 
                },
                success:function(data,status){
                    $('#staffModal').modal('hide');
                    displayData();
                }
            });

        }

        // Delete staff 
        function delStaff(deleteID){
            $.ajax({
                url:"deleteStaff.php",
                type:'post',
                data:{
                    deletesend:deleteID
                },
                success:function(data,status){
                    displayData();
                }
            })
        }

        // Update staff
        function getStaffDetails(updateID){
            $('#hiddenData').val(updateID);

            $.post("updateStaff.php",{updateid:updateID},function(data,status){
                var userid = JSON.parse(data);

                $('#updateFName').val(userid.first_name);
                $('#updateLName').val(userid.last_name);
                $('#updateEmail').val(userid.email);
                $('#updatePassword').val(userid.password);
                $('#updateRole').val(userid.role);

            });

            $('#updateStaffModal').modal("show");
        }

        function updatestaffdetails(){
            var updateFName = $('#updateFName').val();
            var updateLName = $('#updateLName').val();
            var updateEmail = $('#updateEmail').val();
            var updatePassword = $('#updatePassword').val();
            var updateRole = $('#updateRole').val();
            var hiddenData = $('#hiddenData').val();

            $.post("updateStaff.php",{
                updateFName:updateFName,
                updateLName:updateLName,
                updateEmail:updateEmail,
                updatePassword:updatePassword,
                updateRole:updateRole,
                hiddenData:hiddenData
            },function(data,status){
                $('#updateStaffModal').modal('hide');
                displayData();
            });
        }
    </script>
</body>
</html>

